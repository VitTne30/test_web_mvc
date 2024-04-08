<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/danhmuc.php');

$db = new db();
$connect = $db->connect();

$danhmuc = new Danhmuc($connect);

$data = json_decode(file_get_contents("php://input"));

$danhmuc->tendanhmuc = $data->tendanhmuc;

if ($danhmuc->create()) {
	echo json_encode(array('message' => 'danhmuc moi da duoc tao thanh cong'));
} else {
	echo json_encode(array('message' => 'danhmuc chua dc tao'));
}
