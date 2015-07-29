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
if ($mod=='report' AND $act=='view_report'){
	if($currentRoleAccess->write_access == "Y"){
		$_SESSION['id_siswa'] = $_POST['id_siswa'];

		header('location:../../admin.php?mod='.$mod.'&act=addnew');
	}else{
		header('location:../../404.php');
	}
}
}
?>