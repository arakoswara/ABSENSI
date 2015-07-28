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

// Input absen
if ($mod=='absen' AND $act=='view_data'){
	if($currentRoleAccess->write_access == "Y"){
		$_SESSION['idk'] = $_POST['idk'];
		$_SESSION['jam'] = $_POST['jam'];

		header('location:../../admin.php?mod='.$mod.'&act=addnew');
	}else{
		header('location:../../404.php');
	}
}

// Input absen
if ($mod=='absen' AND $act=='input'){
	if($currentRoleAccess->write_access == "Y"){
		$absen = $val->validasi($_POST['absen'],'xss');
		$table = new PoTable('absen');

		$id_siswa = $_POST['id_siswa'];
		$kelas = $_POST['kelas'];
		$tgl = $_POST['tgl'];
		$ket = $_POST['ket'];
		$jam = $_POST['jam'];
		

		for ($i=0; $i < count($id_siswa); $i++) {
			$table->save(array(
				'ida' => '',
				'id_siswa' => $id_siswa[$i],
				'kelas' => $kelas[$i],
				'tgl' => $tgl[$i],
				'ket' => $ket[$i],
				'jam' => $jam[$i]
				));
		}
		header('location:../../admin.php?mod=home');
	}else{
		header('location:../../404.php');
	}
}
}
?>