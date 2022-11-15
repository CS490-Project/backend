<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if ($data["exam_id"] && $data["student_id"]){

        $db = getDB();            
        
        
        $stmt = $db->prepare('SELECT ga.expected, ga.run, ga.pts_possible, ga.pts_deducted, ga.pts_override, 
(pts_possible-pts_override) as pts_total, ga.comment, q.description, sa.answer
FROM cs490_graded_answers ga, cs490_questions q, cs490_student_answers sa, cs490_exam_results er
WHERE ga.student_id=:st_id AND ga.question_id=q.id AND ga.exam_id=:e_id 
AND sa.student_id=:st_id AND sa.question_id=q.id AND sa.exam_id=:e_id 
AND er.student_id=:st_id AND er.exam_id=:e_id');
                                
        $stmt->execute([
            ":e_id" => $data['exam_id'],
            ":st_id" => $data['student_id']
        ]);
        
        
        $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
        
        if($grades){
            echo json_encode($grades);
        } else{
            http_response_code(404);
            echo "Exam not found";
            die();
        }
       
        
        
    }
