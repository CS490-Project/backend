<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php
  
    if (isset($_POST['description'])  && isset($_POST['difficulty']) 
        && isset($_POST['category'])  && isset($_POST['teacher_id'])
        && isset($_POST['fname']) ){


        $db = getDB();
        

        $stmt = $db->prepare('INSERT INTO cs490_questions (description, difficulty, fname, category, teacher_id) VALUES(:desc, :diff, :fn, :cat, :t_id)');
        $r = $stmt->execute([
            ":desc" => $_POST['description'],
            ":diff" => $_POST['difficulty'],
            ":fn" => $_POST['fname'],
            ":cat" => $_POST['category'],
            ":t_id" => $_POST['teacher_id']
        ]);
    

        if($r){
            $q_id = $db->lastInsertId();
            $test_cases = $_POST['test_cases'];

            foreach ($test_cases as $tc) {
                $stmt = $db->prepare('INSERT INTO cs490_test_cases (test_in, test_out, question_id) VALUES(:t_out, :t_in, :q_id)');
                $r = $stmt->execute([
                    ":t_in" => $tc['test_in'],
                    ":t_out" => $tc['test_out'],
                    ":q_id" => $_id
                ]);

                if($r){
                    echo "created Questiona dn Testcases";
                } else {
                    echo "Failed to Create Question";
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
