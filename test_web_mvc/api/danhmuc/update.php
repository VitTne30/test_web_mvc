<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/danhmuc.php');
	
$db = new db();
$connect = $db->connect();

$danhmuc = new Danhmuc($connect);

$data = json_decode(file_get_contents("php://input"));

$danhmuc->id = $data->id;
$danhmuc->tendanhmuc = $data->tendanhmuc;

if($danhmuc->update()){
	echo json_encode(array('message' => 'danhmuc da duoc cap nhat thanh cong'));
}
else{
	echo json_encode(array('message' => 'danhmuc chua the cap nhat'));
}
?>