<?php

	class Database{
		private $dsn = "pgsql:host=localhost;dbname=coursereservation";
		private $user = "postgres";
		private $pass = "postgres";
		public $conn;

		public function __construct(){
			try{
				$this->conn = new PDO($this->dsn, $this->user, $this->pass);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function insertdept($code, $name){
			$sql = "INSERT INTO department(deptCode, deptName) VALUES (:code,:name)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['code'=>$code,'name'=>$name]);
			return true;
		}

		public function readdept(){

			$data = array();
			$sql = "SELECT * FROM department";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			foreach ($result as $row) {
				$data[] = $row;
			}
			return $data;
		}

		public function deptRowCount(){
			$sql = "SELECT * FROM department";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$t_rows = $stmt->rowCount();

			return $t_rows;
		}
	}

?>