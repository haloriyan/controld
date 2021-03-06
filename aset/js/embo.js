/*
	* EmboJS v1.0.0
	* Created by Riyan Satria (c) 2018
	* Licensed open-source under General Public License 3.0
*/

function pilih(select) {
	let sel = document.querySelector(select)
	sel.atribut = function(attr, vals = null) {
		let val = vals || 0
		if(val == "") {
			return sel.getAttribute(attr)
		}else {
			return sel.setAttribute(attr, val)
		}
	}
	sel.klik = function(callback) {
		sel.addEventListener("click", callback)
	}
	sel.klikGanda = function(callback) {
		sel.addEventListener("dblclick", callback)
	}
	sel.tulis = function(evt) {
		sel.innerHTML = evt
	}
	sel.isi = function(vals) {
		let val = vals || 0
		if(val == "") {
			return sel.value
		}else {
			return sel.value = val
		}
	}
	sel.pengaya = function(style) {
		sel.setAttribute("style", style)
	}
	sel.hilang = function() {
		sel.style.display = "none";
	}
	sel.muncul = function() {
		sel.style.display = "block";
	}
	sel.semua = function(callback) {
		let dom = document.querySelectorAll(sel)
		for(i = 0; i < dom.length; i++) {
			callback
		}
	}
	return sel;
}

function mengarahkan(tujuan) {
	document.location = tujuan;
}

// Ajax Handler
function pos(url, data, efek) {
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);

	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			efek();
		}else {
			// console.log("gagal mengirim data");
		}
	}
	xhr.send(data);
}

function ambil(url, sukses) {
	var xhr = new XMLHttpRequest();
	xhr.open('GET', url, true);
	xhr.onreadystatechange = function() {
		if(xhr.readyState == XMLHttpRequest.DONE) {
			var respon = parseScript(xhr.responseText);
			return sukses(respon);
		}else {
			// console.log("gagal mengambil data");
		}
	}
	xhr.send(null);
}

function ambilJSON(url, sukses) {
	var xhr = new XMLHttpRequest()
	xhr.open('GET', url, true)

	xhr.onload = function() {
		if(xhr.status >= 200 && xhr.status < 400) {
			var data = JSON.parse(xhr.responseText)
			return sukses(data)
		}else {
			console.log("gagal mengambil json")
		}
	}

	xhr.send(null)
}

function submit(sel, callback) {
	pilih(sel).onsubmit = function() {
		return callback()
	}
}

// Keyboard Event
function tekan(key, fungsi) {
	document.addEventListener("keydown", function(e) {
		let ctrl = key.split(" ")
		if(ctrl[0] == "ctrl") {
			if(e.ctrlKey && e.key === ctrl[1]) {
				fungsi()
			}
		}else if(ctrl[0] == "alt") {
			if(e.altKey && e.key === ctrl[1]) {
				fungsi()
			}
		}else if(ctrl[0] == "shift") {
			if(e.shiftKey && e.key === ctrl[1]) {
				fungsi()
			}
		}else {
			if(e.key == key) {
				fungsi()
			}
		}
	})
	return false
}

// Scrolling
function scrollKe(dom) {
	pilih(dom).scrollIntoView({
		behavior: 'smooth'
	});
}

function scroll(val) {
	window.scroll({
		top: val,
		behavior: 'smooth'
	});
}

function munculPopup(sel, opt = null) {
	pilih(".bg").muncul()
	pilih(sel).muncul()
	setTimeout(function() {
		pilih(sel + " .popup").pengaya("top: 0px")
		opt
	}, 50);
}
function hilangPopup(sel) {
	pilih(".bg").hilang()
	pilih(sel + " .popup").pengaya("top: -550%");
	setTimeout(function() {
		pilih(sel).hilang()
	}, 250);
}

function setUrlAddr(url) {
	window.history.pushState("a", "b", url);
}

function parseScript(_source) {
	var source = _source;
	var scripts = new Array();

	while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
		var s = source.indexOf("<script");
		var s_e = source.indexOf(">", s);
		var e = source.indexOf("</script");
		var e_e = source.indexOf(">", e);

		scripts.push(source.substring(s_e+1, e));
		source = source.substring(0, s) + source.substring(e_e+1);
	}

	for(var i = 0; i < scripts.length; i++) {
		try {
			eval(scripts[i]);
		} catch(ex) {
			//
		}
	}
	return source;
}

// cookie handle
function setCookie(name, val, expDays) {
	var d = new Date()
	d.setTime(d.getTime() + (expDays*24*60*60*1000))
	var expires = "expires=" + d.toUTCString()
	document.cookie = name + "=" + val + ";" + expires + ";path=/"
}

function getCookie(cname) {
	var name = cname + "="
	var decodedCookie = decodeURIComponent(document.cookie)
	var ca = decodedCookie.split(';')
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i]
		while(c.charAt(0) == " ") {
			c = c.substring(1)
		}
		if(c.indexOf(name) == 0) {
			return c.substring(name.length, c.length)
		}
	}
	return ""
}