<?php 

class Model extends DBConnect{
	function getSlide(){
		$sql = "SELECT *
				FROM table_slide 
		";
		return $this->getOneRow($sql);
	}
	function getCatalog(){ 
		$sql = "SELECT *
				FROM table_catalog
		";
		return $this->getMoreRows($sql);
	}
	function getProduct(){
		$sql = "SELECT *
				FROM table_product
		";
		return $this->getMoreRows($sql);
	}
	function getProductByCatalog($idCatalog){
		$sql = "SELECT *
				FROM table_product
				WHERE idCatalog = $idCatalog

		";
		return $this->getMoreRows($sql);
	}
	function getDetaiProduct($id){
		$sql = "SELECT *
				FROM table_product
				WHERE id = $id
		";
		return $this->getOneRow($sql);
	}
	function register($name,$pass){
		$sql = "INSERT INTO table_user(name,pass)
				VALUES('$name','$pass')
		";
		return $this->executeQuery($sql);
	} 
	function login($name,$pass){
		$sql = "SELECT *
				FROM table_user
				WHERE name = '$name'
				AND pass = '$pass'
		";
		return $this->getOneRow($sql);
	}

	function setBill($idUser,$total){
		$sql = "INSERT INTO table_bill(idUser,total)
				VALUES($idUser,'$total')
		";
		$check = $this->executeQuery($sql);
		if($check){
			return $this->getRecentIdInsert();
		}
		return false;
	}

	function setBillDetail($idBill,$idProduct,$quantity){
		$sql = "INSERT INTO table_bill_detail(idBill,idProduct,quantity)
				VALUES($idBill,$idProduct,'$quantity');
		";
		return $this->executeQuery($sql);
	}

}

?>