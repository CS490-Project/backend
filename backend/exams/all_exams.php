<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    

    $db = getDB();

    $stmt = $db->prepare('SELECT * FROM cs490_exams e 
    WHERE e.id NOT IN (SELECT er.exam_id FROM cs490_exam_results er WHERE er.student_id = :st_id)');
                            
    $stmt->execute([
        ":st_id" => $data['student_id']
    ]);


    $exams = $stmt->fetchAll(PDO::FETCH_ASSOC);
 

    if($exams){
        echo json_encode($exams);
    } else{
        http_response_code(404);
        echo "Exam not found";
        die();
    }
    
        


