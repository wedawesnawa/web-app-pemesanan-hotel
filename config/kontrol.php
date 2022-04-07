<?php

    include "koneksi.php";

    class pesan extends koneksi{
        public function select($table)
	    {
	        global $con;
	        $sql   = "SELECT * FROM $table";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }
		public function select2($table){
			global $con;
			$sql 			= "SELECT * FROM $table";
			$query 			= mysqli_query($con, $sql);
			return $data 	= mysqli_fetch_assoc($query);
		} 
		public function selectWhere($table, $where, $whereValues){
			global $con;
			$sql 			= "SELECT * FROM $table WHERE $where='$whereValues'";
			$query 			= mysqli_query($con, $sql);
			return $data 	= mysqli_fetch_assoc($query);
		} 
        public function insert($table, $values, $redirect){
			global $con;
			$sql = "INSERT INTO $table VALUES($values)";
			$query = mysqli_query($con, $sql);
			if($query){
				return ['response'=>'positive', 'alert'=>'Berhasil Menambahkan Data',  'redirect'=>$redirect];
			}else{
				return ['response'=>'negative', 'alert'=>'Gagal Menambahkan Data'];
			}
		}
		public function update($table, $value, $where, $whereValues, $redirect){
			global $con;
			$sql = "UPDATE $table SET $value WHERE $where='$whereValues'";
			$query = mysqli_query($con, $sql);
			if($query){
				return ['response'=>'positive', 'alert'=>'Berhasil Update Data',  'redirect'=>$redirect];
			}else{
				return ['response'=>'negative', 'alert'=>'Gagal Update Data'];
			}
		}
		public function autokode($table, $field, $pre)
    	{
	        global $con;
	        $sqlc   = "SELECT COUNT($field) as jumlah FROM $table";
	        $querys = mysqli_query($con, $sqlc);
	        $number = mysqli_fetch_assoc($querys);
	        if ($number['jumlah'] > 0) {
	            $sql    = "SELECT MAX($field) as kode FROM $table";
	            $query  = mysqli_query($con, $sql);
	            $number = mysqli_fetch_assoc($query);
	            $strnum = substr($number['kode'], 2, 3);
	            $strnum = $strnum + 1;
	            if (strlen($strnum) == 3) {
	                $kode = $pre . $strnum;
	            } else if (strlen($strnum) == 2) {
	                $kode = $pre . "0" . $strnum;
	            } else if (strlen($strnum) == 1) {
	                $kode = $pre . "00" . $strnum;
	            }
	        } else {
	            $kode = $pre . "001";
	        }

	        return $kode;
    	}
		public function validateHtml($field){
	    	$field = htmlspecialchars($field);
	    	return $field;
	    }
		public function register($table, $idUser, $nama, $email, $username, $password, $level, $confirm, $redirect)
	    {
	    	global $con;
	        global $rg;

	        $sql   = "SELECT * FROM $table WHERE 'username' = '$username'";
	        $query = mysqli_query($con, $sql);
			$rows = mysqli_num_rows($query);

	        if (strlen($username) < 6) {
	            return ['response' => 'negative', 'alert' => 'username minimal 6 Huruf'];
	        }
			if ($rows == 0) {
				$username = strtolower(stripslashes($username));
				$password = htmlspecialchars($password);
				$confirm  = htmlspecialchars($confirm);

				if ($password == $confirm) {
					$password = base64_encode($password);
					$sql = "INSERT INTO $table VALUES('$idUser','$username','$password','$nama','$email','$level')";
					$query = mysqli_query($con, $sql);
					if ($query) {
						return ['response' => 'positive', 'alert' => 'Registrasi Berhasil','redirect' => $redirect];
					} else {

						return ['response' => 'negative', 'alert' => 'Registrasi Error'];
					}
				} else {

					return ['response' => 'negative', 'alert' => 'Password Tidak Cocok'];
				}
			} else if ($rows == 1) {

	            return ['response' => 'negative', 'alert' => 'Username telah digunakan'];
	        }
    	}
		public function register_admin($table, $petugas_id, $nama, $username, $password, $tlp, $role, $confirm, $redirect)
	    {
	    	global $con;
	        global $rg;

	        $sql   = "SELECT * FROM $table WHERE 'username' = '$username'";
	        $query = mysqli_query($con, $sql);
			$rows = mysqli_num_rows($query);

	        if (strlen($username) < 6) {
	            return ['response' => 'negative', 'alert' => 'username minimal 6 Huruf'];
	        }
			if ($rows == 0) {
				$username = strtolower(stripslashes($username));
				$password = htmlspecialchars($password);
				$confirm  = htmlspecialchars($confirm);
				if ($password == $confirm) {
					$password = base64_encode($password);
					$sql = "INSERT INTO $table VALUES('$petugas_id','$nama','$username','$password','$tlp','$role')";
					$query = mysqli_query($con, $sql);
					if ($query) {
						return ['response' => 'positive', 'alert' => 'Registrasi Berhasil', 'redirect' => $redirect];
					} else {

						return ['response' => 'negative', 'alert' => 'Registrasi Error'];
					}
				} else {

					return ['response' => 'negative', 'alert' => 'Password Tidak Cocok'];
				}
			} else if ($rows == 1) {

	            return ['response' => 'negative', 'alert' => 'Password Tidak Cocok'];
	        }
    	}
		public function login($table, $username, $password)
	    {
	        global $con;

	        $sql   = "SELECT * FROM $table WHERE username = '$username'";
	        $query = mysqli_query($con, $sql);
	        $rows  = mysqli_num_rows($query);
	        $assoc = mysqli_fetch_assoc($query);
	        if ($rows > 0) {
	            if (base64_decode($assoc['password']) == $password) {
	                return ['response' => 'positive', 'alert' => 'Berhasil Login', 'password' => $assoc['password']];
	            }else {
	                return ['response' => 'negative', 'alert' => 'Password Salah'];
	            }
	        } else {

	            return ['response' => 'negative', 'alert' => 'Username atau Password Salah'];
	        }
	    }
		public function login_admin($table, $username, $password)
	    {
	        global $con;

	        $sql   = "SELECT * FROM $table WHERE username = '$username'";
	        $query = mysqli_query($con, $sql);
	        $rows  = mysqli_num_rows($query);
	        $assoc = mysqli_fetch_assoc($query);
	        if ($rows > 0) {
	            if (base64_decode($assoc['password']) == $password) {
	                return ['response' => 'positive', 'alert' => 'Berhasil Login', 'level' => $assoc['level']];
	            }else {
	                return ['response' => 'negative', 'alert' => 'Password Salah'];
	            }
	        } else {

	            return ['response' => 'negative', 'alert' => 'Username atau Password Salah'];
	        }
	    }
		public function redirect($redirect)
	    {
	        return ['response' => 'positive', 'alert' => 'Login Berhasil', 'redirect' => $redirect];
	    }
		public function sessionCheck(){
    		if(!isset($_SESSION['username'])){
    			return "false"; 
    		}else{
    			return "true";
    		}
    	}
		public function AuthUser($table, $sessionUser)
    	{
    		global $con;
    		$sql = "SELECT * FROM $table WHERE username = '$sessionUser'";
    		$query = mysqli_query($con, $sql);
    		$bigData = mysqli_fetch_assoc($query);
    		return $bigData;
    	}
		public function logout()
	    {
	        session_destroy();
	        header("Location: index.php");
	        return ['response' => 'positive', 'alert' => 'Selesai'];
	    }
		public function logout2()
	    {
	        session_destroy();
	        header("Location: loginMulti.php");
	        return ['response' => 'positive', 'alert' => 'Logout Berhasil'];
	    }
		public function edit($table, $where, $whereValues)
	    {
	        global $con;
	        $sql   = "SELECT * FROM $table WHERE $where = '$whereValues'";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }
		public function selectWhere2($table, $where, $whereValues)
	    {
	        global $con;
	        $sql   = "SELECT * FROM $table WHERE $where = '$whereValues'";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }
		public function selectWhere3($table, $where, $whereValues, $where2, $whereValues2)
	    {
	        global $con;
	        $sql   = "SELECT * FROM $table WHERE $where = '$whereValues' AND $where2 = '$whereValues2'";
	        $query = mysqli_query($con, $sql);

	        return $data = mysqli_num_rows($query);
	    }
		public function selectFind($table, $where, $whereValues)
	    {
	        global $con;
	        $sql   = "SELECT * FROM $table WHERE $where LIKE '%$whereValues%'";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }
		public function delete($table, $where, $whereValues, $redirect){
			global $con;
			$sql = "DELETE FROM $table WHERE $where='$whereValues'";
			$query = mysqli_query($con, $sql);
			if($query){
				return ['response'=>'positive', 'alert'=>'Berhasil Hapus Data',  'redirect'=>$redirect];
			}else{
				return ['response'=>'negative', 'alert'=>'Gagal Hapus Data'];
			}
		}
		public function select_join($table, $table2, $where, $whereValues){
			global $con;
	        $sql   = "SELECT * FROM $table INNER JOIN $table2 ON $table.id_pelanggan = $table2.id_pelanggan WHERE $table.$where = '$whereValues'";
			$query 			= mysqli_query($con, $sql);
			return $data 	= mysqli_fetch_assoc($query);
		}
		public function select_joinFind($table, $table2, $whereValues){
			global $con;
	        $sql   = "SELECT * FROM $table INNER JOIN $table2 ON $table.id_pelanggan = $table2.id_pelanggan WHERE $table2.nama_tamu LIKE '%$whereValues%' ORDER BY $table2.nama_tamu ASC";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
		}
		public function select_joinTriple($table, $table2, $table3){
			global $con;
	        $sql   = "SELECT * FROM (($table INNER JOIN $table2 ON $table.id_pengaduan = $table2.id_pengaduan)INNER JOIN $table3 ON $table.id_petugas = $table3.id_petugas)";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
		}
		public function getCountRow($table){
	    	global $con;
	    	$sql = "SELECT * FROM $table";
	    	$query = mysqli_query($con, $sql);
	    	$rows = mysqli_num_rows($query);
	    	return $rows;
	    }
		public function getCountRows($table, $where, $whereValues){
	    	global $con;
	    	$sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
	    	$query = mysqli_query($con, $sql);
	    	$rows = mysqli_num_rows($query);
	    	return $rows;
	    }
		public function getCountRowsDouble($table, $where, $whereValues, $where1, $whereValues1){
	    	global $con;
	    	$sql = "SELECT * FROM $table WHERE $where = '$whereValues' AND $where1 = '$whereValues1'";
	    	$query = mysqli_query($con, $sql);
	    	$rows = mysqli_num_rows($query);
	    	return $rows;
	    }
		public function getCountRowsDoubles($table, $where, $whereValues, $where1, $whereValues1){
	    	global $con;
	    	$sql = "SELECT * FROM $table WHERE $where = '$whereValues' OR $where1 = '$whereValues1'";
	    	$query = mysqli_query($con, $sql);
	    	$rows = mysqli_num_rows($query);
	    	return $rows;
	    }
		public function validateImage(){
	    	global $con;
	    	$name 		= $_FILES['foto']['name'];
	    	$ukuranFile = $_FILES['foto']['size'];
	    	$error 		= $_FILES['foto']['error'];
	    	$tmpName 	= $_FILES['foto']['tmp_name'];
	    	$folder = 'img/';
	    	$extensiGambar 		= explode('.', $name);
	    	$namaGambar 		= $extensiGambar[0];
	    	$ekstensiBelakang 	= strtolower(end($extensiGambar));
	    	$ekstensi 			= ['jpg','jpeg','png','gif'];
	    	$error 				= array();

	    	if (in_array($ekstensiBelakang, $ekstensi) === false) {
	            return ['response' => 'negative', 'alert' => 'Gambar hanya boleh menggunakan ekstensi jpg,jpeg,png'];
	        }

	        if ($ukuranFile > 4000000) {
	            return ['response' => 'negative', 'alert' => 'Ukuran gambar terlalu besar'];
	        }

	        if (empty($errors)) {
	            if (!file_exists('img')) {
	                mkdir('img', 0563);
	            }

	        }
	        $name = random_int(1, 999);
	        $name = time() . $name . "." . $ekstensiBelakang;
	        move_uploaded_file($tmpName, $folder . $name);

	        return ['types' => 'true', 'image' => $name];
	    }
    }

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "db_hotel";

    $con = mysqli_connect($hostname, $username, $password, $database) or die("Connection corrupt");

?>