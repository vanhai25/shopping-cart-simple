<?php if(!isset($_SESSION['id_user'])):
header('location:dang-nhap');
return;
else:
	$ids = array_keys($_SESSION['cart']);
?>
<form method="POST">
<div class="container" style="margin-top: 200px">
	<div class="row">
    
  <table class="table">
    <thead>
      <tr>
        <th>Sản phẩm</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>

      </tr>
    </thead>
    <tbody>
    	<?php if(empty($ids)){
    		$products = array();
    	}
    	else{
    		$products=$DB->query('SELECT * FROM table_product WHERE id IN('.implode(',',$ids).')'); // nối các key thành chuỗi cách nhau dấu ,
    	}

    	?>
    	<?php foreach($products as $show): ?>
      <tr>
		
        <td><img src="upload/product/<?=$show->img?>" width="100px"></td>
        <td><?=$show->title?></td>
        <td><?=number_format($show->price)?>đ</td>
        <td><?=$_SESSION['cart'][$show->id]['qty']?></td>
        <td><?=number_format($show->price * $_SESSION['cart'][$show->id]['qty'])?>đ</td>
      </tr>

  	<?php endforeach ?>
    <tr><td>Tổng tiền: <?=number_format($cart->total()['total'])?>đ</td></tr>

    </tbody>
  </table>
  <div class="row" align="right"><button type="submit" name="sm">Đặt hàng</button></div>

</div>
</div>
</form>
<?php endif ?>
