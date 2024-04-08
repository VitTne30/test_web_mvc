<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/account.php');
	
$db = new db();
$connect = $db->connect();

$account = new Account($connect);

$data = json_decode(file_get_contents("php://input"));

$account->id = $data->id;
$account->tentaikhoan = $data->tentaikhoan;
$account->matkhau = $data->matkhau;
$account->email = $data->email;

if($account->update()){
	echo json_encode(array('message', 'account da duoc cap nhat thanh cong'));
}
else{
	echo json_encode(array('message', 'account chua the cap nhat'));
}
?>