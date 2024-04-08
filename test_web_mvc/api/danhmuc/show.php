<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/danhmuc.php');
	
$db = new db();
$connect = $db->connect();

$danhmuc = new Danhmuc($connect);

$danhmuc->id = isset($_GET['id']) ? $_GET['id'] : die();

$danhmuc->show();

//$danhmuc_array = [];
//
//$danhmuc_item = array(
//	'message' => $danhmuc->tendanhmuc,
//);

//array_push($danhmuc_array, $danhmuc_item);

echo json_encode(array('message' => $danhmuc->tendanhmuc));
?>