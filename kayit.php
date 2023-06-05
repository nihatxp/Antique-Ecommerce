<?php
ob_start();
require_once('inc/header.php');
if (isset($_SESSION['Kullanici']) == true ) {
	header("location: kullanicihesabi.php");
	exit;
}
?>
<div class="header-space"></div>
<?php require_once('inc/sidebar-sepet.php'); ?>
<?php require_once('inc/sidebar-menu.php'); ?>
<div class="container">
	<div class="breadcrumb-content">
		<h2>Kaydol</h2>
		<ul>
			<li><a href="#">AnaSayfa</a></li>
			<li> Kaydol </li>
		</ul>
	</div>
</div>
</div>
<div class="register-area ptb-100">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
				<div class="login">
					<div class="login-form-container">
						<div class="login-form">
							<div class="inner">
								<form action="backend/kullanici-kayit.php" method="post" enctype="multipart/form-data">
									<h3>Kayit Formu</h3>
									<div class="form-group">
										<div class="form-wrapper">
											<label for="">Ad Soyad:</label>
											<div class="form-holder">
												<input type="text" name='adsoyad' class="form-control">
											</div>
										</div>
										<div class="form-wrapper">
											<label for="">Email:</label>
											<div class="form-holder">
												<input type="text" name="email" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-wrapper">
											<label for="">Password:</label>
											<div class="form-holder">
												<input type="password" name="password" class="form-control" placeholder="********">
											</div>
										</div>
										<div class="form-wrapper">
											<label for="">Repeat Password:</label>
											<div class="form-holder">
												<input type="password" name="password2" class="form-control" placeholder="********">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="form-wrapper">
											<div class="form-holder">
												<img class='avat' height=90px id='avat' src='ph/avat.jpg' alt='img'>
											</div>
										</div>
									</div>

									<div class="form-wrapper">
										<label for="">Profil Fotografi</label>
										<div class="form-holder">
											<input type="file" name="profil" id='inpfile' accept="image/png, image/jpeg" class="form-control" value="Profil Fotografi">
										</div>
									</div>
							</div>

							<div class="form-group">
								<div class="form-wrapper">
									<label for="">Country:</label>
									<div class="form-holder">
										<select name="adres" id="" class="form-control">
											<?php 
											require_once('inc/countries.php');

											foreach ($countries as $key => $value) {
												echo "<option value='$key'>$value</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-end">
								<div class="button-holder">
									<button class="button" name='submit'>Register Now</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php require_once 'inc/footer.php'; ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	var imgavat = $('#avat');
	var inpfile = $('#inpfile');
	inpfile.on('change', function() {
		if (this.files[0]) {
			var reader = new FileReader();

			reader.readAsDataURL(this.files[0]);

			reader.onloadend = function() {
				imgavat.attr('src', reader.result);
			};
		}
	});
</script>

</html>