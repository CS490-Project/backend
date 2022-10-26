<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if ($data["teacher_id"]){

        $db = getDB();
    
        $stmt_exam = $db->prepare('SELECT e.title, e.id as exam_id, er.student_id, e.teacher_id, e.total, er.score
         FROM cs490_exams e, cs490_exam_results er 
        WHERE e.id=er.exam_id AND e.teacher_id=:t_id AND er.score IS NULL');
                                
        $stmt_exam->execute([
            ":t_id" => $data['teacher_id']
        ]);

        $exam = $stmt_exam->fetchAll(PDO::FETCH_ASSOC);
       
        if($exam){
            //$exam['questions'] = $questions;
            echo json_encode($exam);
        } else{
            http_response_code(404);
            echo json_encode(array());
            die();
        }
       
        
        
    }
