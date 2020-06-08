<?php 
class cart{
    private $DB;
    public function __construct($DB){
        if(!isset($_SESSION)){ // kiểm tra nếu không có session thì start nó
            session_start();
        }
        if(!isset($_SESSION['cart'])){ //kiểm tra nếu không có session giỏ hàng thì tạo cái mới gắn mảng
            $_SESSION['cart'] = array();
        }
        $this->DB = $DB;
        if(isset($_GET['delCart'])){
            $this->del($_GET['delCart']);
            header('location:gio-hang');
            return;
        }



    }
    // public function add($product_id){
    //     if(isset($_SESSION['cart'][$product_id])){  //nếu sản phẩm trong giỏ hàng đã tồn tại 
    //         $_SESSION['cart'][$product_id]++;       // thì session sp đó tăng lên 
    //     }
    //     else{
    //         $_SESSION['cart'][$product_id] = 1; // nếu không tồn tại thì = 1
    //     }
     
    // }

    public function add($product_id,$qty,$size = null,$color = null){
        if(isset($_SESSION['cart'][$product_id])){
            $_SESSION['cart'][$product_id]['qty'] += $qty;
        }
        else{
            $_SESSION['cart'][$product_id] = array('qty' => $qty,'color' => $color, 'size' => $size);


        }
    }


    public function countProduct(){
        $c = array_values($_SESSION['cart']);
        $sum = 0;
        for($i = 0; $i < count($c); $i++){
            $sum += $c[$i]['qty'];
        }
        return $sum;
    }
    public function total(){ // tổng số tiền thanh toán
        $total = 0;                              // Gắn 
        $ids = array_keys($_SESSION['cart']);  
        if(empty($ids)){
            $products = array();
        }
        else{
            $products = $this->DB->query('SELECT id,price FROM table_product WHERE id IN('.implode(',',$ids).')');
        }
        foreach($products as $pro){
     
                $total += $pro->price * $_SESSION['cart'][$pro->id]['qty'];
            
   
        }
        if(isset($_SESSION['useCoin'])){ //Nếu user có dùng chức nâng coin
            if($_SESSION['useCoin'] >= $total ){
                return $x = array('total'=> 0,'coin'=>$_SESSION['useCoin'] - $total); //tiền dư của user COin
            }
            else{
                return $x = array('total'=>$total - $_SESSION['useCoin'], 'coin'=>0);
            }
        }
        return $x = ['total'=>$total];
    }
    // Tính lại tổng khi đã dùng coin

    public function del($product_id){
        unset($_SESSION['cart'][$product_id]); // Xoá session cart dựa vào id sản phẩm
    }
}
?>