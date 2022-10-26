<?php require_once(__DIR__ . "/../config/db.php"); ?>
<?php

    $json = file_get_contents('php://input');
    $graded_answers = json_decode($json, true);

    $db = getDB();

    //Loop through answers and save them as graded_answers
    $student_id = $graded_answers[0]["student_id"];
    $exam_id = $graded_answers[0]["exam_id"];
    $total = 0;
    foreach ($graded_answers as $a) {
        $stmt = $db->prepare('INSERT INTO cs490_graded_answers (expected, run, pts_possible, pts_deducted, pts_override, comment, student_id, exam_id, question_id)
        VALUES(:expected, :run, :possible, :deducted, :override, :comment, :st_id, :e_id, :q_id)');

        $possible = intval($a["pts_possible"]);
        $override = intval($a["pts_override"]);

        $total += $possible-$override;

        $r = $stmt->execute([
            ":expected" => $a["expected"],
            ":run" => $a["run"],
            ":possible" => $a["pts_possible"],
            ":deducted" => $a["pts_deducted"],
            ":override" => $a["pts_override"],
            ":comment" => $a["comment"],
            ":st_id" => $a["student_id"],
            ":e_id" => $a["exam_id"],
            ":q_id" => $a["question_id"],
        ]);
    
    }

    $stmt = $db->prepare('UPDATE cs490_exam_results 
                          SET score=:total
                          WHERE student_id=:st_id AND exam_id=:e_id');
    $r = $stmt->execute([
        ":total" => $total,
        ":st_id" => $student_id,
        ":e_id" => $exam_id
    ]);

