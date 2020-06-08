<?php 

if(isset($_GET['page'])){
	$page = $_GET['page'];
}
else{
	$page = 'home';
}
switch ($page) {
	case 'home':
		$slide = $model->getSlide();
		$catalog = $model->getCatalog();
		$product = $model->getProduct();
		require"view/site/home.php";
		break;
	case 'catalog':
		if(isset($_GET['id'])){
			$idCatalog = $_GET['id'];
			$product = $model->getProductByCatalog($idCatalog);
		}
		require"view/site/catalogProduct.php";
		break;
	case 'detail':
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$product = $model->getDetaiProduct($id);
		}
		require"view/site/detailProduct.php";
		break;
	case 'cart':
		require"view/site/cart.php";
		break;
	case 'checkout':
		if(isset($_POST['sm'])){
			$idUser = $_SESSION['id_user'];
			$total = $cart->total()['total'];
			$idBill = $model->setBill($idUser,$total);
			$ids = array_keys($_SESSION['cart']);
			$products = $DB->query('SELECT * FROM table_product WHERE id IN('.implode(',',$ids).')');
			foreach($products as $item){
				$idProduct = $item->id;
				$quantity = $_SESSION['cart'][$item->id]['qty'];
				$billDetail = $model->setBillDetail($idBill,$idProduct,$quantity);
			}
			unset($_SESSION['cart']);
			header("location:gio-hang");
		}
		require"view/site/checkout.php";
		break;
	case 'login':
		if(isset($_POST['sm'])){
			$name = $_POST['name'];
			$pass = $_POST['pass'];
			$a = $model->login($name,$pass);
			if($a){
				$_SESSION['id_user'] = $a->id;
				$_SESSION['name_user'] = $a->name;
				$mess = 'Đăng nhập thành công';
			}
			else{
				$mess = 'Tài khoản không tồn tại';
			}
		}
		require"view/site/login.php";
		break;
	case 'register':
		if(isset($_POST['sm'])){
			$name = $_POST['name'];
			$pass = $_POST['pass'];

			$a = $model->register($name,$pass);
			if($a){
				$mess = 'Đăng kí thành công';
			}
		}
		require"view/site/register.php";
		break;
	default:
		# code...
		break;
}


?>