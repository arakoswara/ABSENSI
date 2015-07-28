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

// Delete kelas
if ($mod=='kelas' AND $act=='delete'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$tabledel = new PoTable('kelas');
		$tabledel->deleteBy('id_kelas', $id);
		header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Multi Delete kelas
elseif ($mod=='kelas' AND $act=='multidelete'){
	if($currentRoleAccess->delete_access == "Y"){
		$totaldata = $val->validasi($_POST['totaldata'],'xss');
		if ($totaldata != "0"){
			$itemdel = $_POST['item'];
			$tabledel = new PoTable('kelas');
			foreach ($itemdel as $item){
				$id = $val->validasi($item['deldata'],'xss');
				$tabledel->deleteBy('id_kelas', $id);
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
elseif ($mod=='kelas' AND $act=='delimage'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$picture = '';
		$data = array(
			'picture' => $picture
		);
		$table = new PoTable('kelas');
		$table->updateBy('id_kelas', $id, $data);
	}else{
		echo "404 Not Found Access";
	}
}

// Input kelas
elseif ($mod=='kelas' AND $act=='input'){
	if($currentRoleAccess->write_access == "Y"){
		$kelas = $val->validasi($_POST['kelas'],'xss');
		$table = new PoTable('kelas');
		$nama_kelas = $_POST['nama'];
		$table->save(array(
			'id_kelas' => '',
			'nama' => $nama_kelas,
			'kelas' => $kelas
			));
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Edit kelas
elseif ($mod=='kelas' AND $act=='update'){
	if($currentRoleAccess->modify_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$kelas = $val->validasi($_POST['kelas'],'xss');
		$nama = $val->validasi($_POST['nama'],'xss');
			$data = array(
				'id_kelas' => $id,
				'nama' => $nama,
				'kelas' => $kelas
			);
			$table = new PoTable('kelas');
			$table->updateBy('id_kelas', $id, $data);
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}
}
?>