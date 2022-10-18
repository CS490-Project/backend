<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
  
    if ($data['exam_id']){

        $db = getDB();
    
        $stmt_exam = $db->prepare('SELECT * FROM cs490_exams WHERE id=:e_id');
                                
        $stmt_exam->execute([
            ":e_id" => $data['exam_id']
        ]);
        
        $stmt_questions = $db->prepare('SELECT * FROM cs490_exam_questions WHERE exam_id=:e_id');
                                
        $stmt_questions->execute([
            ":e_id" => $data['exam_id']
        ]);
        
        
        $exam = $stmt_exam->fetch(PDO::FETCH_ASSOC);
        $questions = $stmt_questions->fetchAll(PDO::FETCH_ASSOC);
        
  
        if($exam and $questions){
            $exam['questions'] = $questions;
            echo json_encode($exam);
        } else{
            http_response_code(404);
            echo "Exam not found";
            die();
        }
       
        
        
    }
