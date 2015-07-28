<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:../../404.php');
}else{
include_once '../../../po-library/po-database.php';
include_once '../../../po-library/po-function.php';

$val = new Povalidasi;
$mod = $_POST['mod'];
$act = $_POST['act'];

$tableroleaccess = new PoTable('user_role');
$currentRoleAccess = $tableroleaccess->findByAnd(id_level, $_SESSION['leveluser'], module, $mod);
$currentRoleAccess = $currentRoleAccess->current();

// Delete siswa
if ($mod=='siswa' AND $act=='delete'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$tabledel = new PoTable('siswa');
		$tabledel->deleteBy('id_siswa', $id);
		header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Multi Delete siswa
elseif ($mod=='siswa' AND $act=='multidelete'){
	if($currentRoleAccess->delete_access == "Y"){
		$totaldata = $val->validasi($_POST['totaldata'],'xss');
		if ($totaldata != "0"){
			$itemdel = $_POST['item'];
			$tabledel = new PoTable('siswa');
			foreach ($itemdel as $item){
				$id = $val->validasi($item['deldata'],'xss');
				$tabledel->deleteBy('id_siswa', $id);
			}
			header('location:../../admin.php?mod='.$mod);
		}else{
			header('location:../../404.php');
		}
	}else{
		header('location:../../404.php');
	}
}

// Delete Image Update
elseif ($mod=='siswa' AND $act=='delimage'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$picture = '';
		$data = array(
			'picture' => $picture
		);
		$table = new PoTable('siswa');
		$table->updateBy('id_siswa', $id, $data);
	}else{
		echo "404 Not Found Access";
	}
}

// Input siswa
elseif ($mod=='siswa' AND $act=='input'){
	if($currentRoleAccess->write_access == "Y"){
		$siswa = $val->validasi($_POST['siswa'],'xss');
		$table = new PoTable('siswa');
		$nis = $_POST['nis'];
		$nama_siswa = $_POST['nama'];
		$jk = $_POST['jk'];
		$alamat = $_POST['alamat'];
		$idk = $_POST['idk'];
		$tlp = $_POST['tlp'];
		$ayah = $_POST['ayah'];
		$p_ayah = $_POST['p_ayah'];
		$ibu = $_POST['ibu'];
		$p_ibu = $_POST['p_ibu'];
		$pass = $_POST['pass'];
		$table->save(array(
			'id_siswa' => '',
			'nis' => $nis,
			'nama' => $nama_siswa,
			'jk' => $jk,
			'alamat' => $alamat,
			'idk' => $idk,
			'tlp' => $tlp,
			'ayah' => $ayah,
			'p_ayah' => $p_ayah,
			'ibu' => $ibu,
			'p_ibu' => $p_ibu,
			'pass' => $pass
			));
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Edit siswa
elseif ($mod=='siswa' AND $act=='update'){
	if($currentRoleAccess->modify_access == "Y"){
		$id = $val->validasi($_POST['id_siswa'],'sql');
		$nis = $_POST['nis'];
		$nama_siswa = $_POST['nama'];
		$jk = $_POST['jk'];
		$alamat = $_POST['alamat'];
		$idk = $_POST['idk'];
		$tlp = $_POST['tlp'];
		$ayah = $_POST['ayah'];
		$p_ayah = $_POST['p_ayah'];
		$ibu = $_POST['ibu'];
		$p_ibu = $_POST['p_ibu'];
		$pass = $_POST['pass'];

		$data = array(
			'id_siswa' => $id,
			'nis' => $nis,
			'nama' => $nama_siswa,
			'jk' => $jk,
			'alamat' => $alamat,
			'idk' => $idk,
			'tlp' => $tlp,
			'ayah' => $ayah,
			'p_ayah' => $p_ayah,
			'ibu' => $ibu,
			'p_ibu' => $p_ibu,
			'pass' => $pass
			);

		$table = new PoTable('siswa');
		$table->updateBy('id_siswa', $id, $data);

		header('location:../../admin.php?mod='.$mod);

	}else{
		header('location:../../404.php');
	}
}
}
?>