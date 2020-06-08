<?php 
require"app/model/DBConnect.php";
require"app/controller/CartController.php";
require"app/model/Model.php";


$model = new Model();
$DB = new DBConnect();
$cart = new cart($DB);


?>