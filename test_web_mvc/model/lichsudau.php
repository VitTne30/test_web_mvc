<?php

class Lichsudau{
	private $conn;
	
	public $id;
	public $tentaikhoan;
	public $thoigian;
	public $diemso;
	
	public function __construct($db){
		$this->conn =$db;
	}
	
	public function show(){
		$query = "SELECT * FROM lichsudau WHERE tentaikhoan=:tentaikhoan";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':tentaikhoan', $this->tentaikhoan);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function create(){
		$query = "INSERT INTO lichsudau SET tentaikhoan=:tentaikhoan , thoigian=:thoigian , diemso=:diemso";
		
		$stmt = $this->conn->prepare($query);
		
		$this->tentaikhoan = htmlspecialchars(strip_tags($this->tentaikhoan));
		$this->thoigian = htmlspecialchars(strip_tags($this->thoigian));
		$this->diemso = htmlspecialchars(strip_tags($this->diemso));
		
		$stmt->bindParam(':tentaikhoan', $this->tentaikhoan);
		$stmt->bindParam(':thoigian', $this->thoigian);
		$stmt->bindParam(':diemso', $this->diemso);
		
		if($stmt->execute()){
			return true;
		}
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
}

?>