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

// Hapus absen
if ($mod=='absen' AND $act=='delete'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$tabledel = new PoTable('absen');
		$tabledel->deleteBy('id_absen', $id);
		header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Multi Delete absen
elseif ($mod=='absen' AND $act=='multidelete'){
	if($currentRoleAccess->delete_access == "Y"){
		$totaldata = $val->validasi($_POST['totaldata'],'xss');
		if ($totaldata != "0"){
			$itemdel = $_POST['item'];
			$tabledel = new PoTable('absen');
			foreach ($itemdel as $item){
				$id = $val->validasi($item['deldata'],'xss');
				$tabledel->deleteBy('id_absen', $id);
			}
			header('location:../../admin.php?mod='.$mod);
		}else{
			header('location:../../404.php');
		}
	}else{
		header('location:../../404.php');
	}
}

// Input absen
elseif ($mod=='absen' AND $act=='input'){
	if($currentRoleAccess->write_access == "Y"){
		$idk = $val->validasi($_POST['idk'],'xss');
		$jam = $val->validasi($_POST['jam'],'xss');

		$_SESSION['idk'] = $idk;
		$_SESSION['jam'] = $jam;

		echo $_SESSION['idk']."<br>";
		echo $_SESSION['jam']."<br>";

		header('location:../../admin.php?mod='.$mod.'&act=addnew');
	}else{
		header('location:../../404.php');
	}
}

// Edit absen
elseif ($mod=='absen' AND $act=='update'){
	if($currentRoleAccess->modify_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$title = $val->validasi($_POST['title'],'xss');
		$seotitle = seo_title($title);
		$active = $val->validasi($_POST['active'],'xss');
			$data = array(
				'title' => $title,
				'seotitle' => $seotitle,
				'active' => $active
			);
			$table = new PoTable('absen');
			$table->updateBy('id_absen', $id, $data);
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}
}
?>