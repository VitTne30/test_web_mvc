<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/question.php');
	
$db = new db();
$connect = $db->connect();

$question = new Question($connect);

if($question->truncate_cauhoi_dalay()){
	echo json_encode(array('message', 'da xoa du lieu bang tam'));
}
else{
	echo json_encode(array('message', 'chua xoa duoc'));
}
?>