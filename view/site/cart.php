<?php 
if(!empty($_SESSION['cart'])):
	$ids = array_keys($_SESSION['cart']);
?>
  <form method="POST" action="?page=cart">
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
        <th>Xoá</th>
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
		    <input type="hidden" class="pid" name="pid" value="<?=$show->id?>">
        <td><img src="upload/product/<?=$show->img?>" width="100px"></td>
        <td><?=$show->title?></td>
        <td><?=number_format($show->price)?>đ</td>
        <td><input min="1" max="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control itemQty" style="width: 75px" type="number"   value="<?=$_SESSION['cart'][$show->id]['qty']?>"></td>
        <td><?=number_format($show->price * $_SESSION['cart'][$show->id]['qty'])?>đ</td>
        <td><a href="?page=cart&delCart=<?=$show->id?>">Xoá</a></td>
      </tr>

  	<?php endforeach ?>
    <tr><td>Tổng tiền: <?=number_format($cart->total()['total'])?>đ</td></tr>

    </tbody>
  </table>
  <div class="row" align="right"><button class="btn btn-primary" type="button" onclick="location.href='thanh-toan'">Thanh toán</button></div>

</div>
</div>
</form>

  <?php else: ?>
    <div class="container" style="margin-top: 200px">
<h4>Giỏ hàng của bạn rỗng</h4>
</div>
<?php endif ?>
<!-- Update qty by ajax -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.itemQty').on('change',function(){
      var $el = $(this).closest('tr');

      var pid = $el.find('.pid').val();
      var qty = $el.find('.itemQty').val();
     
   
      location.reload('true');
      console.log(qty);
      $.ajax({
        url:'addCart.php',
        method:'POST',
        cache:'false',
        data:{qty:qty,pid:pid},
        success:function(data){
          console.log(data);
        }
      })
    })
  });
</script>


