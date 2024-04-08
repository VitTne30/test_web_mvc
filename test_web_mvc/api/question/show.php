<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/question.php');
	
$db = new db();
$connect = $db->connect();

$question = new Question($connect);

$question->id = isset($_GET['id']) ? $_GET['id'] : die();

$question->show();

$question_array = [];
$question_array['question'] = [];

$question_item = array(
	'id' => $question->id,
	'title' => $question->title,
	'cau_a' => $question->cau_a,
	'cau_b' => $question->cau_b,
	'cau_c' => $question->cau_c,
	'cau_d' => $question->cau_d,
	'cau_dung' => $question->cau_dung,
	'id_danhmuc' => $question->id_danhmuc,
);

array_push($question_array['question'], $question_item);

print_r(json_encode($question_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

?>