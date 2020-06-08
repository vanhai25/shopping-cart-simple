<?php 
class DBConnect{
	private $conn = null;
	private $stsm = null;
	function __construct($dbname='shop',$username='root',$password=''){
		$dsn = "mysql:dbname=$dbname;host=localhost";
		try{
			$this->conn = new PDO($dsn,$username,$password, array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
			));
		
		}
		catch(PDOException $e){
			echo $e->getMessage();
			die;

		}
	}
	//hàm update/delete/insert
	function executeQuery($sql){
		$this->stsm = $this->conn->prepare($sql);
		return $this->stsm->execute();
	}
	//hàm lấy nhiều dòng
	function getMoreRows($sql){
		$check = $this->executeQuery($sql);
		if($check){
			return $this->stsm->fetchAll(PDO::FETCH_OBJ);
		}
		return false;
	}
	function getOneRow($sql){
		$check = $this->executeQuery($sql);
		if($check){
			return $this->stsm->fetch(PDO::FETCH_OBJ);
		}
		return false;
	}
   	function getRecentIdInsert(){
    	return $this->conn->lastInsertId();
    }

	function query($sql, $data = array()){
		$this->stsm = $this->conn->prepare($sql);
		$this->stsm->execute($data);
		return $this->stsm->fetchAll(PDO::FETCH_OBJ); 
	}



}
?>