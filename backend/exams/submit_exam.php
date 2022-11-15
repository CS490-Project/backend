<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php
    
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data["student_id"] && $data["exam_id"]){

        

        $exam_id = $data["exam_id"];
        $student_id = $data["student_id"];
        $db = getDB();

        //Create new pending exam results
        
        $stmt = $db->prepare('INSERT INTO cs490_exam_results (student_id, exam_id) VALUES(:st_id, :e_id)');
        $r = $stmt->execute([
            ":st_id" => $student_id,
            ":e_id" => $exam_id,
        ]);

        if($r){

            //Loop through answers and create student answer
       
            $answers = $data['answers'];
            
            foreach ($answers as $a) {
                $stmt = $db->prepare('INSERT INTO cs490_student_answers (answer, student_id, question_id, exam_id) VALUES(:ans, :st_id, :q_id, :e_id)');
                $r = $stmt->execute([
                    ":ans" => $a['answer'],
                    ":st_id" => $student_id,
                    ":q_id"=> $a['question_id'],
                    ":e_id" => $exam_id
                ]);

            
                if($r){
                    echo "Submitted Exam Answer\n";
                } else {
                    echo "Failed to Submit Exam Answer\n";
                    http_response_code(500);
                    die();
                }
                
            }
        } else{
            echo "Failed to Submit Exam";
            http_response_code(500);
            die();
        }
        
    } 
