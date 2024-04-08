<?php

class Account{
	private $conn;
	
	public $id;
	public $tentaikhoan;
	public $matkhau;
	public $email;
	
	public function __construct($db){
		$this->conn =$db;
	}
	
	public function login(){
		$query = "SELECT * FROM taikhoan WHERE tentaikhoan=:tentaikhoan AND matkhau=:matkhau LIMIT 1";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':tentaikhoan', $this->tentaikhoan);
		$stmt->bindParam(':matkhau', $this->matkhau);
		
		if($stmt->execute()){
			if($stmt->rowCount() > 0){
				return true;
			}
			else{
				return false;
			}
		}
		
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
	
	public function admin(){
		$query = "SELECT * FROM admin ORDER BY id ASC";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		return $stmt;
	}
	
	public function changePass(){
		$query = "UPDATE taikhoan SET matkhau =:matkhau WHERE tentaikhoan =:tentaikhoan";
		
		$stmt = $this->conn->prepare($query);
		
		$this->tentaikhoan = htmlspecialchars(strip_tags($this->tentaikhoan));
		$this->matkhau = htmlspecialchars(strip_tags($this->matkhau));
		
		$stmt->bindParam(':tentaikhoan', $this->tentaikhoan);
		$stmt->bindParam(':matkhau', $this->matkhau);
		
		if($stmt->execute()){
			return true;
		}
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
	
	public function read(){
		$query = "SELECT * FROM taikhoan ORDER BY id ASC";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		return $stmt;
	}
	
	public function show(){
		$query = "SELECT * FROM taikhoan WHERE id=? LIMIT 1";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->tentaikhoan = $row['tentaikhoan'];
		$this->matkhau = $row['matkhau'];
		$this->email = $row['email'];
	}
	
	public function create(){
		$query = "INSERT INTO taikhoan SET tentaikhoan=:tentaikhoan , matkhau=:matkhau , email=:email ";
		
		$stmt = $this->conn->prepare($query);
		
		$this->tentaikhoan = htmlspecialchars(strip_tags($this->tentaikhoan));
		$this->matkhau = htmlspecialchars(strip_tags($this->matkhau));
		$this->email = htmlspecialchars(strip_tags($this->email));
		
		$stmt->bindParam(':tentaikhoan', $this->tentaikhoan);
		$stmt->bindParam(':matkhau', $this->matkhau);
		$stmt->bindParam(':email', $this->email);
		
		if($stmt->execute()){
			return true;
		}
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
	
	public function update(){
		$query = "UPDATE taikhoan SET tentaikhoan=:tentaikhoan , matkhau =:matkhau , email =:email WHERE id =:id";
		
		$stmt = $this->conn->prepare($query);
		
		$this->tentaikhoan = htmlspecialchars(strip_tags($this->tentaikhoan));
		$this->matkhau = htmlspecialchars(strip_tags($this->matkhau));
		$this->email = htmlspecialchars(strip_tags($this->email));
		
		$stmt->bindParam(':tentaikhoan', $this->tentaikhoan);
		$stmt->bindParam(':matkhau', $this->matkhau);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':id', $this->id);
		
		if($stmt->execute()){
			return true;
		}
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
	
	public function delete(){
		$query = "DELETE FROM taikhoan WHERE id =:id";
		
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