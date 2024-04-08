<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/lichsudau.php');
	
$db = new db();
$connect = $db->connect();

$lichsudau = new Lichsudau($connect);

$data = json_decode(file_get_contents("php://input"));

$lichsudau->tentaikhoan = $data->tentaikhoan;
$lichsudau->thoigian = $data->thoigian;
$lichsudau->diemso = $data->diemso;

if($lichsudau->create()){
	echo json_encode(array('message', 'lichsudau moi da duoc tao thanh cong'));
}
else{
	echo json_encode(array('message', 'lichsudau chua dc tao'));
}
?>