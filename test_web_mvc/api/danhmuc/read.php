<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/danhmuc.php');
	
$db = new db();
$connect = $db->connect();

$danhmuc = new Danhmuc($connect);
$read = $danhmuc->read();

$num = $read->rowCount();

if($num>0){
	$danhmuc_array = [];
	
	while($row = $read->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
		$danhmuc_item = array(
			'id' => $id,
			'tendanhmuc' => $tendanhmuc,
		);
		array_push($danhmuc_array, $danhmuc_item);
	}
//	echo json_encode($question_array);
	$json_string = json_encode($danhmuc_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	echo $json_string;
}
	
?>