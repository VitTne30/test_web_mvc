<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/lichsudau.php');
	
$db = new db();
$connect = $db->connect();

$lichsudau = new Lichsudau($connect);

$data = json_decode(file_get_contents("php://input"));

$lichsudau->tentaikhoan = $data->tentaikhoan;

$show = $lichsudau->show();

$num = $show->rowCount();

if($num>0){
	$lichsudau_array = [];
	
	while($row = $show->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$lichsudau_item = array(
		'id' => $row['id'],
		'tentaikhoan' => $lichsudau->tentaikhoan,
		'thoigian' => $row['thoigian'],
		'diemso' => $row['diemso'],
		);
		
		array_push($lichsudau_array, $lichsudau_item);
	}
}

print_r(json_encode($lichsudau_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

?>