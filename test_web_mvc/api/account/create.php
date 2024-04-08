<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/account.php');
	
$db = new db();
$connect = $db->connect();

$account = new Account($connect);

$data = json_decode(file_get_contents("php://input"));

$account->tentaikhoan = $data->tentaikhoan;
$account->matkhau = $data->matkhau;
$account->email = $data->email;

if($account->create()){
	echo json_encode(array('message' => 'account moi da duoc tao thanh cong'));
}
else{
	echo json_encode(array('message' => 'account chua dc tao'));
}
?>