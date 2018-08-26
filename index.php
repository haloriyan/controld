<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<meta name="description" content="Bookmark all of your site URL on the cloud">
	<meta name="keyword" content="social bookmarking online bookmark site">
	<title>Controld | Save your favorite sites</title>
	<link href="aset/fw/build/fw.css" rel="stylesheet">
	<link href="aset/fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="aset/css/style.index.css" rel="stylesheet">
</head>
<body>

<div class="atas">
	<h1 class='judul ke-kiri'>Controld</h1>
	<div class='ke-kanan' id='tblLogin'>SIGN IN</div>
</div>

<div class="container">
	<div class="wrap">
		<h2>Bookmark all of your site URL on the cloud</h2>
		<p>Doesn't need same device or even same browser</p>
		<button id='cta' class='tbl biru'>Try it now!</button>
	</div>
</div>

<div class="icon">
	<i class='fa fa-globe'></i>
</div>

<script src="aset/js/embo.js"></script>
<script>
	pilih("#cta").klik(() => {
		mengarahkan("./user/register")
	})
	pilih("#tblLogin").klik(() => {
		mengarahkan("./user/login")
	})
</script>
</body>
</html>
