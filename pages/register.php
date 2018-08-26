<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Register Controld Account</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.login.css' rel='stylesheet'>
</head>
<body>

<div class="container" style='top: 60px;'>
	<div class="wrap">
		<h2>Register Controld Account</h2>
		<form id='formReg'>
			<input type="text" class='box' id='name' placeholder='Name' required>
			<input type="email" class='box' id='email' placeholder='Email' required>
			<input type="password" class='box' id='pwd' placeholder='Password' required>
			<input type="checkbox" id='agree' required> <label for='agree'>I agree for User's Agreement</label>
			<div class="bag-tombol">
				<button class='biru'>SIGN IN</button>
			</div>
			<div class="opt rata-tengah">
				already have an account? <a href="./login">login</a> now!
			</div>
		</form>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id='successReg'>
	<div class="popup">
		<div class="wrap">
			<h3><i class='fa fa-info'></i> &nbsp; Success Registered
				<div class="ke-kanan" id='xSukses'><i class='fa fa-close'></i></div>
			</h3>
			<p>
				Before login, you must verify your email address that already sent to your email. If you cant find it, try to check spam folder
			</p>
		</div>
	</div>
</div>

<script src='../aset/js/embo.js'></script>
<script>
	submit("#formReg", () => {
		let name = pilih("#name").isi()
		let email = pilih("#email").isi()
		let pwd = pilih("#pwd").isi()
		let reg = "name="+name+"&email="+email+"&pwd="+pwd
		pos("./register", reg, () => {
			mengarahkan("../dashboard")
		})
		return false
	})
	tekan("Escape", () => {
		hilangPopup("#successReg")
	})
	pilih("#xSukses").klik(() => {
		hilangPopup("#successReg")
	})
</script>

</body>
</html>