<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php
    
    $json = file_get_contents('php://input');
  
    if ($json){

        $data = json_decode($json, true);
        $db = getDB();
        

        $stmt = $db->prepare('INSERT INTO cs490_questions (description, difficulty, fname, category, teacher_id) VALUES(:desc, :diff, :fn, :cat, :t_id)');
        $r = $stmt->execute([
            ":desc" => $data['description'],
            ":diff" => $data['difficulty'],
            ":fn" => $data['fname'],
            ":cat" => $data['category'],
            ":t_id" => $data['teacher_id']
        ]);
    

        if($r){
            $q_id = $db->lastInsertId();
            $test_cases = $data['test_cases'];

            foreach ($test_cases as $tc) {
                $stmt = $db->prepare('INSERT INTO cs490_test_cases (test_in, test_out, question_id) VALUES(:t_out, :t_in, :q_id)');
                $r = $stmt->execute([
                    ":t_in" => $tc['test_in'],
                    ":t_out" => $tc['test_out'],
                    ":q_id" => $q_id
                ]);

                if($r){
                    echo "Created Testcase\n";
                } else {
                    echo "Failed to Create Testcase";
                    http_response_code(500);
                    die();
                }
                
            }
        } else{
            echo "Failed to Create Question";
            http_response_code(500);
            die();
        }
        
    } 
