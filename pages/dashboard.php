<?php
include 'aksi/ctrl/url.php';

$sesi = $user->auth(1);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Dashboard | Controld</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href='aset/css/style.dashboard.css' rel='stylesheet'>
</head>
<body>

<div class="atas">
	<div id="tblMenu" onclick='menu(this.getAttribute("aksi"))' aksi='xMenu'><i class='fa fa-bars'></i></div>
	<div id="tblMenuMob" onclick='menuMob(this.getAttribute("aksi"))' aksi='bkMenu'><i class='fa fa-bars'></i></div>
	<h1 class='judul ke-kiri'>Dashboard</h1>
	<form class='ke-kanan' id='formCari'>
		<input type="text" class='box' oninput='cari(this.value)' placeholder='Search bookmark...'>
		<button id='search'><i class='fa fa-search'></i></button>
	</form>
</div>

<div class="kiri">
	<a href="#"><li><div id="icon"><i class='fa fa-home'></i></div> Dashboard</li></a>
	<a href="./trash"><li><div id="icon"><i class='fa fa-trash'></i></div> Trash</li></a>
	<a href="./user/logout"><li><div id="icon"><i class='fa fa-sign-out'></i></div> Sign Out</li></a>
</div>

<div class="container">
	<div class="wrap">
		<h3>Add new Bookmark</h3>
		<form id='addNew'>
			URL :<br />
			<input type="text" class='box' id='url' autocomplete='off'>
			<button class='tbl biru' id='save'>Save</button>
		</form>
		<h3>My Bookmark</h3>
		<div id='load'></div>
	</div>
</div>

<button class='biru' id='create'><i class='fa fa-pencil'></i></button>

<div class="bg"></div>
<div class="popupWrapper" id='saveUrl'>
	<div class="popup">
		<div class="wrap">
			<h3>Bookmark New URL
				<div class="ke-kanan" id='xSave'><i class='fa fa-close'></i></div>
			</h3>
			<form id='save'>
				<div>URL :</div>
				<input type="text" class='box' id='urlSave' required autocomplete='off'>
				<div class='bag-tombol'>
					<button class='biru'>Bookmark!</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="popupWrapper" id='deleteUrl'>
	<div class="popup">
		<div class="wrap">
			<h3>Delete Site
				<div class="ke-kanan" id='xDelete'><i class='fa fa-close'></i></div>
			</h3>
			<form id='formDelete'>
				<input type="hidden" id='idurl'>
				<p>Sure want to delete this site?</p>
				<div class="bag-tombol">
					<button class='biru'>Yes, I Sure!</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src='aset/js/embo.js'></script>
<script src='aset/js/script.dashboard.js'></script>

</body>
</html>