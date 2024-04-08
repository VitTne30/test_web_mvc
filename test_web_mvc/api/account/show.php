<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/account.php');
	
$db = new db();
$connect = $db->connect();

$account = new Account($connect);

$account->id = isset($_GET['id']) ? $_GET['id'] : die();

$account->show();

$account_item = array(
	'id' => $account->id,
	'tentaikhoan' => $account->tentaikhoan,
	'matkhau' => $account->matkhau,
	'email' => $account->email,
);

echo json_encode($account_item);

?>