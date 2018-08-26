<?php
include 'controller.php';

class user extends controller {
	public function me($id, $kolom) {
		$q = $this->tabel("user")->pilih($kolom)->dimana(["email" => $id])->eksekusi();
		if($this->hitung($q) == 0) {
			$q = $this->tabel("user")->pilih($kolom)->dimana(["iduser" => $id])->eksekusi();
		}
		$r = $this->ambil($q);
		return $r[$kolom];
	}
	public function register() {
		if($this->pos("email") != null) {
			$nama = $this->pos("name");
			$email = $this->pos("email");
			$pwd = $this->pos("pwd");

			$q = $this->tabel("user")
					  ->tambah([
						  "iduser" => rand(1, 99999),
						  "nama" => $nama,
						  "email" => $email,
						  "password" => $pwd,
						  "status" => 1,
						  "registered" => time()
					  ])->eksekusi();
			$this->login($email);
			return $q;
		}else {
			return lihat('register');
		}
	}
	public function logout() {
		session_start();
		session_destroy();
		header("location: ./login");
	}
	public function login($email = NULL) {
		if($this->pos("email") != null or $email != null) {
			$e = $this->pos("email") or $email;
			$p = $this->pos("pwd");

			$em = $this->me($e, "email");
			$pw = $this->me($e, "password");

			if($e == $em && $p == $pw) {
				$status = $this->me($e, "status");
				if($status != 0) {
					session_start();
					$_SESSION['ucontrold']=$e;
				}else {
					setcookie('kukiLogin', 'Your account not activated yet. Please confirmation your email address before using your account', time() + 66, "/");
				}
			}else {
				setcookie('kukiLogin', 'Email / Password wrong!', time() + 66, "/");
			}
		}else {
			return lihat('login');
		}
	}
	public function auth($opt = NULL) {
		session_start();
		$this->sesi = $_SESSION['ucontrold'];
		if($opt != NULL) {
			if(empty($this->sesi)) {
				header("location: ./user/login");
			}
		}
		return $this->sesi;
	}
}

$user = new user();

?>