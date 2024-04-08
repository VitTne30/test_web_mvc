<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/question.php');
	
$db = new db();
$connect = $db->connect();

$question = new Question($connect);
$getData = $question->getData();

$num = $getData->rowCount();

if($num>0){
	$question_array = [];
	
	while($row = $getData->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
		$question_item = array(
			'id' => $id,
			'title' => $title,
			'cau_a' => $cau_a,
			'cau_b' => $cau_b,
			'cau_c' => $cau_c,
			'cau_d' => $cau_d,
			'cau_dung' => $cau_dung,
			'id_danhmuc' => $id_danhmuc,
		);
		array_push($question_array, $question_item);
	}
//	echo json_encode($question_array);
	$json_string = json_encode($question_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	echo $json_string;
}
	
?>