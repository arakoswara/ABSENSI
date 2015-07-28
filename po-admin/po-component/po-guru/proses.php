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

// Delete guru
if ($mod=='guru' AND $act=='delete'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$tabledel = new PoTable('guru');
		$tabledel->deleteBy('id_guru', $id);
		header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Multi Delete guru
elseif ($mod=='guru' AND $act=='multidelete'){
	if($currentRoleAccess->delete_access == "Y"){
		$totaldata = $val->validasi($_POST['totaldata'],'xss');
		if ($totaldata != "0"){
			$itemdel = $_POST['item'];
			$tabledel = new PoTable('guru');
			foreach ($itemdel as $item){
				$id = $val->validasi($item['deldata'],'xss');
				$tabledel->deleteBy('id_guru', $id);
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
elseif ($mod=='guru' AND $act=='delimage'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$picture = '';
		$data = array(
			'picture' => $picture
		);
		$table = new PoTable('guru');
		$table->updateBy('id_guru', $id, $data);
	}else{
		echo "404 Not Found Access";
	}
}

// Input guru
elseif ($mod=='guru' AND $act=='input'){
	if($currentRoleAccess->write_access == "Y"){
		$guru = $val->validasi($_POST['guru'],'xss');
		$table = new PoTable('guru');
		$nip = $_POST['nip'];
		$nama_guru = $_POST['nama'];
		$jk = $_POST['jk'];
		$alamat = $_POST['alamat'];
		$idk = $_POST['idk'];
		$pass = $_POST['pass'];
		$table->save(array(
			'id_guru' => '',
			'nip' => $nip,
			'nama' => $nama_guru,
			'jk' => $jk,
			'alamat' => $alamat,
			'idk' => $idk,
			'pass' => $pass
			));
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Edit guru
elseif ($mod=='guru' AND $act=='update'){
	if($currentRoleAccess->modify_access == "Y"){
		$id = $val->validasi($_POST['id_guru'],'sql');
		$nip = $_POST['nip'];
		$nama_guru = $_POST['nama'];
		$jk = $_POST['jk'];
		$alamat = $_POST['alamat'];
		$idk = $_POST['idk'];
		$pass = $_POST['pass'];


		$data = array(
			'id_guru' => $id,
			'nip' => $nip,
			'nama' => $nama_guru,
			'jk' => $jk,
			'alamat' => $alamat,
			'idk' => $idk,
			'pass' => $pass
			);
			$table = new PoTable('guru');
			$table->updateBy('id_guru', $id, $data);
			header('location:../../admin.php?mod='.$mod);
			// echo $id." ".$nip." ".$nama_guru;
		}else{
			echo "gagal";
		}
	}else{
		header('location:../../404.php');
	}
}
?>