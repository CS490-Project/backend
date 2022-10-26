<?php


$data = [
	"description" => "Write a function doublenum that returns the double of an integer",
	"difficulty" => 0,
	"fname" => "doublenum",
	"category"=> "variables",
	"teacher_id"=> "tt001",
	"test_cases"=> [
		["test_in"=> "doublenum(5)", "test_out"=> "10"],
		["test_in"=> "doublenum(10)", "test_out"=> "20"]
	]
];

$options = array(
    CURLOPT_URL => 'https://afsaccess4.njit.edu/~gc348/CS490/backend/questions/create_question.php',
    CURLOPT_POST => true, 
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER, array('Content-Type:application/json'),
    CURLOPT_RETURNTRANSFER => true
);

$ch = curl_init();  //initialize curl session
curl_setopt_array($ch, $options); 


//decode json from db.php
$response = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

echo $response;
?>