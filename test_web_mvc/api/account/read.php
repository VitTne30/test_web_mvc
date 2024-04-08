<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/account.php');
	
$db = new db();
$connect = $db->connect();

$account = new Account($connect);
$read = $account->read();

$num = $read->rowCount();

if($num>0){
	$account_array = [];
	
	while($row = $read->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
		$account_item = array(
			'id' => $id,
			'tentaikhoan' => $tentaikhoan,
			'matkhau' => $matkhau,
			'email' => $email,
		);
		array_push($account_array, $account_item);
	}
	$json_string = json_encode($account_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	echo $json_string;
}
	
?>