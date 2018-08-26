function load() {
    ambil("./url/my", (res) => {
        pilih("#load").tulis(res)
    })
}
function hapus(val) {
    pilih("#idurl").isi(val)
    munculPopup("#deleteUrl", pilih("#deleteUrl").pengaya("top: 180px"))
}
function cari(val) {
    let set = "namakuki=cari&value="+val+"&durasi=3666"
    pos("./aksi/setCookie.php", set, () => {
        load()
    })
}
function hint(val) {
    let param = "idurl="+val
    pos("./url/hint", param, () => {
        //
    })
}
load()

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

window.addEventListener("scroll", function() {
	var skrol = window.pageYOffset
	if(skrol >= 150) {
        pilih("#create").muncul()
	}else {
        pilih("#create").hilang()
	}
})

pilih("#create").klik(() => {
    munculPopup("#saveUrl", pilih("#saveUrl").pengaya("top: 180px"))
})
tekan("Escape", () => {
    hilangPopup("#saveUrl")
    hilangPopup("#deleteUrl")
})
pilih("#xSave").klik(() => {
    hilangPopup("#saveUrl")
})
pilih("#xDelete").klik(() => {
    hilangPopup("#deleteUrl")
})

function save(add) {
    pos("./url/add", add, () => {
        pilih("#url").value = ''
        pilih("#urlSave").value = ''
        hilangPopup("#saveUrl")
        load()
    })
}

submit("#addNew", () => {
    let url = pilih("#url").isi()
    let add = "url="+url
    save(add)
    return false;
})
submit("#formDelete", () => {
    let id = pilih("#idurl").isi()
    let del = "id="+id
    pos("./url/delete", del, () => {
        hilangPopup("#deleteUrl")
        load()
    })
})
submit("#saveUrl", () => {
    let url = pilih("#urlSave").isi()
    let add = "url="+url
    save(add)
    return false
})
submit("#formCari", () => {
    return false
})