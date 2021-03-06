<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
$aksi="po-component/po-guru/proses.php";
?>
	<div class="content-header">
		<div class="header-section"><h1><?=$langguru1;?></h1></div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li><a href="admin.php?mod=home"><?=$langmenu1;?></a></li>
		<li><?=$langguru2;?></li>
	</ul>
<?php
switch($_GET[act]){
	default:
?>
	<div class="block full">
		<div class="block-title"><h2><?=$langguru1;?></h2></div>
		<div class="table-responsive">
			<form method="post" action="<?=$aksi;?>">
				<input type="hidden" name="mod" value="guru">
				<input type="hidden" name="act" value="multidelete">
				<input type="hidden" value="0" name="totaldata" id="totaldata">
				<table cellpadding="0" cellspacing="0" border="0" class="dTableAjax table table-vcenter table-condensed table-bordered" id="dynamic">
					<thead><tr>
						<th style="width:80px;" class="text-center"><i class="fa fa-check-circle-o"></i></th>
						<th>NIP</th>
						<th>Nama <?=$langmenu61;?></th>
						<th><?=$langmenu63;?></th>
						</tr></thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<td style="width:80px;" class="text-center"><input type="checkbox" id="titleCheck" data-toggle="tooltip" title="<?=$langaction5;?>" /></td>
							<td colspan="5">
								<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#alertalldel"><i class="fa fa-trash-o"></i> Delete Selected Item</button>
							</td>
						</tr>
					</tfoot>
				</table>
			</form>
		</div>
	</div>
	<div id="alertdel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> <?=$langdelete1;?></h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="guru">
						<input type="hidden" name="act" value="delete">
						<input type="hidden" id="delid" name="id">
						<?=$langdelete2;?>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> <?=$langdelete3;?></button>
						<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> <?=$langdelete4;?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<p style="width:100%; height:350px;">&nbsp;</p>
<?php
    break;

	case "addnew":
    $permastr = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    $permastrlink = preg_replace("/\/po-admin\/(admin\.php$)/","",$permastr);
?>
	<div class="block full">
		<div class="block-title"><h2>Add New</h2></div>
		<form id="form-validation" class="form-bordered" method="post" action="<?=$aksi;?>" autocomplete="off">
            <fieldset>
				<input type="hidden" name="mod" value="guru">
				<input type="hidden" name="act" value="input">
				<div class="form-group">
					<label>NIP <span class="text-danger">*</span></label>
					<input class="form-control" type="text" id="nip" name="nip" required>
				</div>
                <div class="form-group">
					<label>Nama Guru <span class="text-danger">*</span></label>
                    <div class="pull-right text-danger" style="font-style:italic;">Permalink : <?=$permastrlink;?>/guru/<span id="permalink"></span></div>
					<input class="form-control" type="text" id="nama" name="nama" required>
				</div>
				<div class="form-group">
					<label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jk" class="form-control" required>
                    	<option>-- Pilih --</option>
                    	<option value="L">Laki-laki</option>
                    	<option value="P">Perempuan</option>
                    </select>
				</div>
				<div class="form-group">
					<label>Kelas <span class="text-danger">*</span></label>
                    <?php
                    $tablecats = new PoTable("kelas");
                    $cats = $tablecats->findAll(id_kelas, ASC);
                    $numcats = $tablecats->numRow();
                    if ($numcats > 0){
                    	echo "<select class='select-chosen' name='idk' style='width:280px;' data-placeholder='Choose a Category'>";
                    		echo "<option value=''>-- Pilih --</option>";
                    	foreach($cats as $cat){
                    		echo "<option value='$cat->id_kelas'>$cat->kelas</option>";
                    	}
                    	echo "</select>";
                    }
                    ?>
				</div>
				<div class="form-group">
					<label>Password <span class="text-danger">*</span></label>
					<input class="form-control" type="text" id="pass" name="pass" required>
				</div>
				<!-- <div class="form-group">
					<label>Image</label>
					<div class="col-md-6 input-group">
						<input class="form-control" type="text" id="picture" name="picture">
						<span class="input-group-btn">
							<a href="js/plugins/filemanager/dialog.php?type=1&field_id=picture" class="btn btn-success" id="browse-file">Browse</a>
						</span>
					</div>
				</div> -->
				<div class="form-group">
					<label>Alamat <span class="text-danger">*</span></label>
					<textarea class="form-control" id="alamat" name="alamat" required rows="5px" required></textarea>
				</div>
				<div class="form-group form-actions">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					<button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
				</div>
            </fieldset>
		</form>
	</div>
	<p style="width:100%; height:100px;">&nbsp;</p>
<?php
	break;

	case "edit":
	$valid = $val->validasi($_GET['id'],'sql');
	$table = new PoTable('guru');
	$currentGuru = $table->findBy(id_guru, $valid);
	$currentGuru = $currentGuru->current();
	if ($currentGuru == '0'){
?>
	<div class="block block-alt-noborder">
		<h3 class="sub-header">Ooops! <?=$langpagenotfound1;?></h3>
		<p>&nbsp;</p>
		<p align="center">
			<?php
				$url = rtrim("http://".$_SERVER['HTTP_HOST'], "/").$_SERVER['PHP_SELF'];
				$url2 = preg_replace("/\/(admin\.php$)/","",$url);
				$siteurl = $url2;
			?>
			<a title="Back to Previous page" class="btn btn-sm btn-primary" onClick="history.back();"><?=$langpagenotfound3;?></a>
			<a href="<?=$siteurl;?>" title="Back to the website" class="btn btn-sm btn-primary"><?=$langpagenotfound2;?></a>
		</p>
		<p>&nbsp;</p>
	</div>
	<p style="width:100%; height:500px;">&nbsp;</p>
<?php
	}else{
	$dutf = html_entity_decode($currentGuru->content);
    $permastr = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    $permastrlink = preg_replace("/\/po-admin\/(admin\.php$)/","",$permastr);
?>
	<div class="block full">
		<div class="block-title"><h2>Edit guru</h2></div>
		<form id="form-validation" class="form-bordered" method="post" action="<?=$aksi;?>" autocomplete="off">
            <fieldset>
				<input type="hidden" name="mod" value="guru">
				<input type="hidden" name="act" value="update">
				<input type="hidden" name="id_guru" value="<?=$currentGuru->id_guru;?>">
				<div class="form-group">
					<label>NIP <span class="text-danger">*</span></label>
					<input class="form-control" type="text" id="nip" name="nip" required value="<?=$currentGuru->nip;?>">
				</div>
                <div class="form-group">
					<label>Nama Guru <span class="text-danger">*</span></label>
                    <div class="pull-right text-danger" style="font-style:italic;">Permalink : <?=$permastrlink;?>/guru/<span id="permalink"></span></div>
					<input class="form-control" type="text" id="nama" name="nama" required value="<?=$currentGuru->nama;?>">
				</div>
				<div class="form-group">
					<label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jk" class="form-control" required>
                    	<option value="<?=$currentGuru->jk;?>"><?=$currentGuru->jk;?></option>
                    	<option value="L">Laki-laki</option>
                    	<option value="P">Perempuan</option>
                    </select>
				</div>
				<div class="form-group">
					<label>Kelas <span class="text-danger">*</span></label>
                    <?php
                    $tablecats = new PoTable("kelas");
                    $cats = $tablecats->findAll(id_kelas, ASC);
                    $numcats = $tablecats->numRow();
                    if ($numcats > 0){
                    	echo "<select class='select-chosen' name='idk' style='width:280px;' data-placeholder='Choose a Category'>";
                    		echo "<option value='$currentGuru->idk'>$currentGuru->idk</option>";
                    	foreach($cats as $cat){
                    		echo "<option value='$cat->id_kelas'>$cat->kelas</option>";
                    	}
                    	echo "</select>";
                    }
                    ?>
				</div>
				<div class="form-group">
					<label>Password <span class="text-danger">*</span></label>
					<input class="form-control" type="text" id="pass" name="pass" required value="<?=$currentGuru->pass;?>">
				</div>
				<!-- <div class="form-group">
					<label>Image</label>
					<div class="col-md-6 input-group">
						<input class="form-control" type="text" id="picture" name="picture">
						<span class="input-group-btn">
							<a href="js/plugins/filemanager/dialog.php?type=1&field_id=picture" class="btn btn-success" id="browse-file">Browse</a>
						</span>
					</div>
				</div> -->
				<div class="form-group">
					<label>Alamat <span class="text-danger">*</span></label>
					<textarea class="form-control" id="alamat" name="alamat" required rows="5px" required><?=$currentGuru->alamat;?></textarea>
				</div>
				<div class="form-group form-actions">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					<button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
				</div>
            </fieldset>
		</form>
	</div>
    <div id="alertdelimg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> <?=$langdelete1;?></h3>
					</div>
					<div class="modal-body">
						<?=$langdelete2;?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-danger btn-del-image" id=""><i class="fa fa-trash-o"></i> <?=$langdelete3;?></button>
						<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> <?=$langdelete4;?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<p style="width:100%; height:100px;">&nbsp;</p>
<?php
	}
    break;
}
}
?>