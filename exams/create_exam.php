<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php
    
    $json = file_get_contents('php://input');
  
    if ($json){

        $data = json_decode($json, true);
        $db = getDB();
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

        $stmt = $db->prepare('INSERT INTO cs490_exams (total, teacher_id) VALUES(:total, :t_id)');
        $r = $stmt->execute([
            ":total" => $data['total'],
            ":t_id" => $data['teacher_id']
        ]);
    

        if($r){
            $exam_id = $db->lastInsertId();
            $questions = $data['questions'];

            foreach ($questions as $q) {
                $stmt = $db->prepare('INSERT INTO cs490_exam_questions (value, question_id, exam_id) VALUES(:val, :q_id, :e_id)');
                $r = $stmt->execute([
                    ":val" => $q['val'],
                    ":q_id"=> $q['q_id'],
                    ":e_id" => $exam_id
                ]);

                if($r){
                    echo "Created Exam Question\n";
                } else {
                    echo "Failed to Create Exam Question";
                    http_response_code(500);
                    die();
                }
                
            }
        } else{
            echo "Failed to Create Exam";
            http_response_code(500);
            die();
        }
        
    } 
