<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/question.php');
	
$db = new db();
$connect = $db->connect();

$question = new Question($connect);

$question->id = isset($_GET['id']) ? $_GET['id'] : die();

$question->read_one();

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

echo json_encode($question_item, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>