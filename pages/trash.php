<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Trash | Controld</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href='aset/css/style.dashboard.css' rel='stylesheet'>
</head>
<body>

<div class="atas">
	<div id="tblMenu" onclick='menu(this.getAttribute("aksi"))' aksi='xMenu'><i class='fa fa-bars'></i></div>
	<div id="tblMenuMob" onclick='menuMob(this.getAttribute("aksi"))' aksi='bkMenu'><i class='fa fa-bars'></i></div>
	<h1 class='judul ke-kiri'>Trash</h1>
	<form class='ke-kanan' id='formCari'>
		<input type="text" class='box' oninput='cari(this.value)' placeholder='Search bookmark...'>
		<button id='search'><i class='fa fa-search'></i></button>
	</form>
</div>

<div class="kiri">
	<a href="./dashboard"><li><div id="icon"><i class='fa fa-home'></i></div> Dashboard</li></a>
	<a href="#"><li><div id="icon"><i class='fa fa-trash'></i></div> Trash</li></a>
	<a href="./user/logout"><li><div id="icon"><i class='fa fa-sign-out'></i></div> Sign Out</li></a>
</div>

<div class="container">
	<div class="wrap">
		<div id="load"></div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id='deleteUrl'>
	<div class="popup">
		<div class="wrap">
			<h3>Delete Site
				<div class="ke-kanan" id='xDel'><i class='fa fa-close'></i></div>
			</h3>
			<form id='formDelete'>
				<input type="hidden" id='idurl'>
				<p>Sure delete this site permanently?</p>
				<div class="bag-tombol">
					<button class='biru'>Yes, Delete this!</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="popupWrapper" id='restoreUrl'>
	<div class="popup">
		<div class="wrap">
			<h3>Restore Site
				<div class="ke-kanan" id='xRes'><i class='fa fa-close'></i></div>
			</h3>
			<form id='formRestore'>
				<input type="hidden" id='idurls'>
				<p>Want get back this site?</p>
				<div class="bag-tombol">
					<button class='biru'>Get this back!</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src='aset/js/embo.js'></script>
<script>
function menu(aksi) {
    if(aksi == "xMenu") {
        pilih(".kiri").pengaya("left: -100%")
        pilih(".atas").pengaya("left: 0%")
        pilih(".container").pengaya("left: 0%")
        pilih("#tblMenu").atribut("aksi", "bkMenu")
    }else {
        pilih(".kiri").pengaya("left: 0%")
        pilih(".atas").pengaya("left: 25%")
        pilih(".container").pengaya("left: 25%")
        pilih("#tblMenu").atribut("aksi", "xMenu")
    }
}
function menuMob(aksi) {
    if(aksi == "xMenu") {
        pilih(".kiri").pengaya("left: -100%")
        pilih(".atas").pengaya("left: 0%;right: 0%")
        pilih(".container").pengaya("left: 0%;right: 0%")
        pilih("#tblMenuMob").atribut("aksi", "bkMenu")
    }else {
        pilih(".kiri").pengaya("left: 0%")
        pilih(".atas").pengaya("left: 50%;")
        pilih(".container").pengaya("left: 65%;")
        pilih("#tblMenuMob").atribut("aksi", "xMenu")
    }
}
function load() {
	ambil("./url/trash", (res) => {
		pilih("#load").tulis(res)
	})
}
function cari(val) {
    let set = "namakuki=cari&value="+val+"&durasi=3666"
    pos("./aksi/setCookie.php", set, () => {
        load()
    })
}
function hapus(val) {
    pilih("#idurl").isi(val)
    munculPopup("#deleteUrl", pilih("#deleteUrl").pengaya("top: 180px"))
}
function restore(val) {
	pilih("#idurls").isi(val)
    munculPopup("#restoreUrl", pilih("#restoreUrl").pengaya("top: 180px"))
}
load()

tekan("Escape", () => {
	hilangPopup("#deleteUrl")
	hilangPopup("#restoreUrl")
})
pilih("#xDel").klik(() => {
	hilangPopup("#deleteUrl")
})
pilih("#xRes").klik(() => {
	hilangPopup("#restoreUrl")
})

submit("#formRestore", () => {
	let id = pilih("#idurls").isi()
	let rest = "id="+id
	pos("./url/restore", rest, () => {
		hilangPopup("#restoreUrl")
		load()
	})
	return false
})
submit("#formDelete", () => {
	let id = pilih("#idurl").isi()
	let del = "id="+id
	pos("./url/deletes", del, () => {
		hilangPopup("#deleteUrl")
		load()
	})
	return false
})
</script>

</body>
</html>