<?php
include 'user.php';

class url extends user {
	public function info($id, $kolom) {
		$q = $this->tabel("url")->pilih($kolom)->dimana(["short" => $id])->eksekusi();
		if($this->hitung($q) == 0) {
			$q = $this->tabel("url")->pilih($kolom)->dimana(["idurl" => $id])->eksekusi();
		}
		$r = $this->ambil($q);
		return $r[$kolom];
	}
	public function add() {
		$author = $this->auth(1);
		$url 	= $this->pos("url");
		
		$add = $this->tabel("url")
					->tambah([
						"idurl" 	=> rand(1, 999999),
						"author" 	=> $author,
						"url" 		=> $url,
						"title"		=> $this->getTitle($url),
						"status"	=> 1,
						"hint"		=> 0,
						"added" 	=> time()
					])->eksekusi();
		return $add;
	}
	public function delete() {
		$id  = $this->pos("id");
		$del = $this->tabel("url")->ubah(["status" => 0])->dimana(["idurl" => $id])->eksekusi();
		return $del;
	}
	public function deletes() {
		$id  = $this->pos("id");
		$del = $this->tabel("url")->hapus()->dimana(["idurl" => $id])->eksekusi();
		return $del;
	}
	public function restore() {
		$id  = $this->pos("id");
		$del = $this->tabel("url")->ubah(["status" => 1])->dimana(["idurl" => $id])->eksekusi();
		return $del;
	}
	public function edit() {
		$id 	= $this->pos("id");
		$kolom 	= $this->pos("kolom");
		$value 	= $this->pos("value");

		$edit = $this->tabel("url")
					 ->ubah([$kolom => $value])
					 ->dimana(["idurl" => $id])
					 ->eksekusi();
		return $edit;
	}
	public function getImage($url) {
		$homepage = file_get_contents($url);

		$img = preg_match_all("{<img\\s*(.*?)src=('.*?'|\".*?\"|[^\\s]+)(.*?)\\s*/?>}ims", $homepage, $gambar, PREG_SET_ORDER);
		foreach ($gambar as $val) {
			$tr = trim($val[2], '" '."'");
			echo "<img src='".$tr."'>";
		}
	}
	public function getTitle($url) {
		$fp = file_get_contents($url);
        if (!$fp) 
            return null;

        $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
        if (!$res) 
            return null; 

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
	}
	public function hint() {
		$id = $this->pos("idurl");
		$q = $this->query("UPDATE url SET hint = hint + 1 WHERE idurl = '$id'");
		return $q;
	}
	public function my() {
		$cari = $_COOKIE['cari'];
		$id = $this->auth(1);
		$q = $this->tabel("url")->pilih()->dimana(["author" => $id,"title" => $cari, "status" => 1], "LIKE")->urutkan("added", "desc")->eksekusi();

		if($this->hitung($q) == 0) {
			echo "No bookmark found";
		}else {
			while($r = $this->ambil($q)) {
				echo "<li class='link' onclick='hint(this.value)' value='".$r['idurl']."'>".
						"<div class='wrap'>".
							"<h3><a href='".$r['url']."' target='_blank'>".$r['title']."</a>".
								"<li class='ke-kanan' id='delete' onclick='hapus(this.value)' value='".$r['idurl']."'><i class='fa fa-trash'></i></li>".
							"</h3>".
							"<p><a style='text-decoration: underline;' href='".$r['url']."' target='_blank'>".substr($r['url'], 0, 25)."...</a></p>".
						"</div>".
					 "</li>";
			}
		}
	}
	public function trash() {
		$cari = $_COOKIE['cari'];
		$id = $this->auth(1);
		$q = $this->tabel("url")->pilih()->dimana(["author" => $id, "title" => $cari, "status" => 0], "LIKE")->urutkan("added", "desc")->eksekusi();
		if($this->hitung($q) == 0) {
			echo "Your trash is empty";
		}else {
			while($r = $this->ambil($q)) {
				echo "<li class='link'>".
						"<div class='wrap'>".
							"<h3><a href='".$r['url']."' target='_blank'>".$r['title']."</a>".
								"<li class='ke-kanan' id='delete' onclick='hapus(this.value)' value='".$r['idurl']."'><i class='fa fa-trash'></i></li>".
								"<li class='ke-kanan' id='delete' onclick='restore(this.value)' value='".$r['idurl']."' style='margin: 8px 25px 0px 0px;font-size: 16px;'>restore</li>".
							"</h3>".
							"<p><a style='text-decoration: underline;' href='".$r['url']."' target='_blank'>".substr($r['url'], 0, 25)."...</a></p>".
						"</div>".
					 "</li>";
			}
		}
	}
}

$url = new url();

?>