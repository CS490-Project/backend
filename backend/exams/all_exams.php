<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    

    $db = getDB();

    $stmt = NULL;

    if(intval($data["graded"]) == 1){
        $stmt = $db->prepare('SELECT * FROM cs490_exams e 
        WHERE e.id IN (SELECT er.exam_id FROM cs490_exam_results er WHERE er.student_id = :st_id AND er.score IS NOT NULL)');

    } else{
        $stmt = $db->prepare('SELECT * FROM cs490_exams e 
        WHERE e.id NOT IN (SELECT er.exam_id FROM cs490_exam_results er WHERE er.student_id = :st_id)');
    }

                            
    $stmt->execute([
        ":st_id" => $data['student_id']
    ]);


    $exams = $stmt->fetchAll(PDO::FETCH_ASSOC);
 

    if($exams){
        echo json_encode($exams);
    } else{
        echo json_encode(array());
        die();
    }
    
        


