<div class="container" style="margin: 200px auto" align="center">
	<div class="box" style="width: 500px; padding: 20px; border: 1px solid #cccccccc; ">
		<h3>Đăng ký tài khoản</h3>
		<?php if(isset($mess)) echo $mess; ?>
		<form method="POST">
			<input type="text" name="name">
			<input type="password" name="pass">
			<button style="margin:30px" type="submit" name="sm">Đăng ký</button>
		</form>
	</div>
</div>