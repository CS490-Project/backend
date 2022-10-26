<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if ($data["student_id"] && $data["exam_id"] ){

        $db = getDB();
        $stmt_student_answers = $db->prepare('SELECT sa.student_id, sa.exam_id, sa.answer, q.id as question_id, q.description, q.fname, eq.value
                                  FROM cs490_student_answers sa, cs490_questions q, cs490_exam_questions eq
                                  WHERE eq.exam_id=:e_id AND eq.question_id=q.id AND sa.question_id=q.id AND sa.student_id=:st_id AND sa.exam_id=:e_id');
                                
        $stmt_student_answers->execute([
            ":st_id" => $data['student_id'],
            ":e_id" => $data["exam_id"]
        ]);


        $student_answers = $stmt_student_answers->fetchAll(PDO::FETCH_ASSOC);

        if($student_answers){
            echo json_encode($student_answers, true);
        } else{
            http_response_code(404);
            echo "Answers exam not found for this student\n";
            die();
        }


    
        
        
    }
