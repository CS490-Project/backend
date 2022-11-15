<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
    $exam_results = json_decode($json, true);

    $db = getDB();

    //Loop through answers and save them as graded_answers
    $student_id = $exam_results["student_id"];
    $exam_id = $exam_results["exam_id"];
    $graded_answers = $exam_results["answers"];
    $total = 0;
    foreach ($graded_answers as $a) {
        $stmt = $db->prepare('INSERT INTO cs490_graded_answers (pts_earned, comment, student_id, exam_id, question_id)
        VALUES(:pts_earned, :comment, :st_id, :e_id, :q_id)');

        $total += floatval($a["pts_earned"]);

        $r = $stmt->execute([
            ":pts_earned" => $a["pts_earned"],
            ":comment" => $a["comment"],
            ":st_id" => $exam_results["student_id"],
            ":e_id" => $exam_results["exam_id"],
            ":q_id" => $a["question_id"],
        ]);

        $test_case_results = $a["test_cases"];
        foreach ($test_case_results as $tcr){

            $stmt = $db->prepare('INSERT INTO cs490_test_case_results (expected, run, pts_possible, pts_deducted, pts_override, student_id, exam_id, question_id, test_case_id)
            VALUES(:expected, :run, :possible, :deducted, :override, :st_id, :e_id, :q_id, :tc_id)');
            
            $tc_id = $tcr["test_case_id"];
            $r = $stmt->execute([
                ":expected" => $tcr["expected"],
                ":run" => $tcr["run"],
                ":possible" => $tcr["pts_possible"],
                ":deducted" => $tcr["pts_deducted"],
                ":override" => $tcr["pts_override"],
                ":st_id" => $exam_results["student_id"],
                ":e_id" => $exam_results["exam_id"],
                ":q_id" => $a["question_id"],
                ":tc_id" => intval($tc_id) == 0 ? null : $tc_id,
            ]);
        }
    
    }

    $stmt = $db->prepare('UPDATE cs490_exam_results 
                          SET score=:total
                          WHERE student_id=:st_id AND exam_id=:e_id');
    $r = $stmt->execute([
        ":total" => $total,
        ":st_id" => $student_id,
        ":e_id" => $exam_id
    ]);

    if($r){
        echo "Graded Exam\n";
    } else {
        echo "Failed to Grade Exam\n";
        http_response_code(500);
        die();
    }
    

