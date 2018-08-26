<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Login to Controld</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.login.css' rel='stylesheet'>
</head>
<body>

<div class="container">
	<div class="wrap">
		<h2>Login to Controld</h2>
		<form id='formLogin'>
			<input type="email" class='box' id='email' placeholder='Email' required>
			<input type="password" class='box' id='pwd' placeholder='Password' required>
			<div class="bag-tombol">
				<button class='biru'>SIGN IN</button>
			</div>
			<div class="opt rata-tengah">
				dont have account? <a href="./register">register</a> now!
			</div>
		</form>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id='notif'>
	<div class="popup">
		<div class="wrap">
			<h3><i class='fa fa-info'></i> &nbsp; Alert!
				<div class="ke-kanan" id='xNotif'><i class='fa fa-close'></i></div>
			</h3>
			<p><?php echo $_COOKIE['kukiLogin']; ?></p>
		</div>
	</div>
</div>

<script src='../aset/js/embo.js'></script>
<script>
	submit("#formLogin", () => {
		let email = pilih("#email").isi()
		let pwd = pilih("#pwd").isi()
		let log = "email="+email+"&pwd="+pwd
		pos("./login", log, () => {
			mengarahkan("../dashboard")
		})
		return false
	})
	tekan("Escape", () => {
		hilangPopup("#notif")
	})
	pilih("#xNotif").klik(() => {
		hilangPopup("#notif")
	})
</script>
<?php
if(isset($_COOKIE['kukiLogin'])) {
	echo '<script>
munculPopup("#notif", pilih("#notif").pengaya("top: 190px"))
</script>';
}
?>

</body>
</html>