<?php

class Danhmuc{
	private $conn;
	
	public $id;
	public $tendanhmuc;
	
	public function __construct($db){
		$this->conn =$db;
	}
	
	public function read(){
		$query = "SELECT * FROM danhmuc ORDER BY id ASC";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		return $stmt;
	}
	
	public function show(){
		$query = "SELECT * FROM danhmuc WHERE id=? LIMIT 1";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->tendanhmuc = $row['tendanhmuc'];
	}
	
	public function create(){
		$query = "INSERT INTO danhmuc SET tendanhmuc=:tendanhmuc ";
		
		$stmt = $this->conn->prepare($query);
		
		$this->tendanhmuc = htmlspecialchars(strip_tags($this->tendanhmuc));
		
		$stmt->bindParam(':tendanhmuc', $this->tendanhmuc);
		
		if($stmt->execute()){
			return true;
		}
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
	
	public function update(){
		$query = "UPDATE danhmuc SET tendanhmuc=:tendanhmuc WHERE id=:id";
		
		$stmt = $this->conn->prepare($query);
		
		$this->tendanhmuc = htmlspecialchars(strip_tags($this->tendanhmuc));
		
		$stmt->bindParam(':tendanhmuc', $this->tendanhmuc);
		$stmt->bindParam(':id', $this->id);
		
		if($stmt->execute()){
			return true;
		}
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
	
	public function delete(){
		$query = "DELETE FROM danhmuc WHERE id =:id";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);
		
		if($stmt->execute()){
			return true;
		}
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
}

?>