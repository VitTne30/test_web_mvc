<?php

class Question{
	private $conn;
	
	public $id;
	public $title;
	public $cau_a;
	public $cau_b;
	public $cau_c;
	public $cau_d;
	public $cau_dung;
	public $id_danhmuc;
	
	public function __construct($db){
		$this->conn =$db;
	}
	
	public function truncate_cauhoi_dalay(){
		$query = "TRUNCATE TABLE cauhoi_dalay";
		
		$stmt = $this->conn->prepare($query);
		
		try {
			if($stmt->execute()){
				return true;
			}
		} catch(PDOException $e) {
			echo json_encode(array('message' => $e->getMessage()));
		}
		return false;
	}
	
	public function insert_cauhoi_dalay(){
		$query = "INSERT INTO cauhoi_dalay (id) VALUES (:id)";
		
		$stmt = $this->conn->prepare($query);
		
		$this->id = $this->id;
		
		$stmt->bindParam(':id', $this->id);
		
		try {
			if($stmt->execute()){
				return true;
			}
		} catch(PDOException $error) {
			echo json_encode(array('message' => $error->getMessage()));
		}
		return false;
	}
	
	public function getData(){
		$query = "SELECT * FROM cauhoi ORDER BY id";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		return $stmt;
	}
	
	public function read(){
		$query = "SELECT * FROM cauhoi WHERE id NOT IN (SELECT id FROM cauhoi_dalay) ORDER BY RAND() LIMIT 1";
		
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		return $stmt;
	}
	
	public function read_one(){
		$query = "SELECT * FROM cauhoi WHERE id=? LIMIT 1";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->title = $row['title'];
		$this->cau_a = $row['cau_a'];
		$this->cau_b = $row['cau_b'];
		$this->cau_c = $row['cau_c'];
		$this->cau_d = $row['cau_d'];
		$this->cau_dung = $row['cau_dung'];
		$this->id_danhmuc = $row['id_danhmuc'];
	}
	
	public function show(){
		$query = "SELECT * FROM cauhoi WHERE id_danhmuc=? AND id NOT IN (SELECT id FROM cauhoi_dalay) ORDER BY RAND() LIMIT 1";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id'];
		$this->title = $row['title'];
		$this->cau_a = $row['cau_a'];
		$this->cau_b = $row['cau_b'];
		$this->cau_c = $row['cau_c'];
		$this->cau_d = $row['cau_d'];
		$this->cau_dung = $row['cau_dung'];
		$this->id_danhmuc = $row['id_danhmuc'];
		
		return $stmt;
	}
	
	public function create(){
		$query = "INSERT INTO cauhoi SET title=:title , cau_a =:cau_a , cau_b =:cau_b , cau_c =:cau_c , cau_d =:cau_d , cau_dung =:cau_dung , id_danhmuc =:id_danhmuc ";
		
		$stmt = $this->conn->prepare($query);
		
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
		$this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
		$this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
		$this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
		$this->cau_dung = htmlspecialchars(strip_tags($this->cau_dung));
		$this->id_danhmuc = $this->id_danhmuc;
		
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':cau_a', $this->cau_a);
		$stmt->bindParam(':cau_b', $this->cau_b);
		$stmt->bindParam(':cau_c', $this->cau_c);
		$stmt->bindParam(':cau_d', $this->cau_d);
		$stmt->bindParam(':cau_dung', $this->cau_dung);
		$stmt->bindParam(':id_danhmuc', $this->id_danhmuc);
		
		if($stmt->execute()){
			return true;
		}
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
	
	public function update(){
		$query = "UPDATE cauhoi SET title=:title , cau_a =:cau_a , cau_b =:cau_b , cau_c =:cau_c , cau_d =:cau_d , cau_dung =:cau_dung , id_danhmuc =:id_danhmuc WHERE id =:id";
		
		$stmt = $this->conn->prepare($query);
		
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
		$this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
		$this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
		$this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
		$this->cau_dung = htmlspecialchars(strip_tags($this->cau_dung));
		$this->id_danhmuc = $this->id_danhmuc;
		
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':cau_a', $this->cau_a);
		$stmt->bindParam(':cau_b', $this->cau_b);
		$stmt->bindParam(':cau_c', $this->cau_c);
		$stmt->bindParam(':cau_d', $this->cau_d);
		$stmt->bindParam(':cau_dung', $this->cau_dung);
		$stmt->bindParam(':id_danhmuc', $this->id_danhmuc);
		$stmt->bindParam(':id', $this->id);
		
		if($stmt->execute()){
			return true;
		}
		printf("ERROR %s.\n" ,$stmt->error);
		return false;
	}
	
	public function delete(){
		$query = "DELETE FROM cauhoi WHERE id =:id";
		
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