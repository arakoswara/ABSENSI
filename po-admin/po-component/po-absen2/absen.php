<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
$aksi="po-component/po-absen/proses.php";
?>
	<div class="content-header">
		<div class="header-section"><h1><?=$langabsen2;?><?php echo " | Jam Pelajaran Ke - ". $_SESSION['jam'];?></h1></div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li><a href="admin.php?mod=home"><?=$langmenu1;?></a></li>
		<li><?=$langabsen2;?></li>
	</ul>
<?php
switch($_GET[act]){
	default:
?>
	<div class="block full">
		<div class="block-title"><h2>Add New</h2></div>
		<form id="form-validation" class="form-bordered" method="post" action="<?=$aksi;?>" autocomplete="off">
            <fieldset>
				<input type="hidden" name="mod" value="absen">
				<input type="hidden" name="act" value="input">
				<input type="hidden" name="param" value="idk">
				<div class="form-group">
					<label>Kelas <span class="text-danger">*</span></label>
					<?php
					$tablecats = new PoTable("kelas");
					$cats = $tablecats->findAll(id_kelas, ASC);
					$numcats = $tablecats->numRow();
					if ($numcats > 0){
						echo "<select class='select-chosen' name='idk' style='width:280px;' data-placeholder='Choose a Category'>";
						foreach($cats as $cat){
							echo "<option value='$cat->id_kelas'>$cat->kelas</option>";
						}
						echo "</select>";
					}
					?>
				</div>
				<div class="form-group">
					<label>Jam Pelajaran Ke <span class="text-danger">*</span></label>
					<select name="jam" class="form-control">
						<option value="1">Jam Ke - 1</option>
						<option value="2">Jam Ke - 2</option>
						<option value="3">Jam Ke - 3</option>
						<option value="4">Jam Ke - 4</option>
						<option value="5">Jam Ke - 5</option>
					</select>
				</div>
				<div class="form-group form-actions">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					<button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
				</div>
            </fieldset>
		</form>
	</div>
	<p style="width:100%; height:500px;">&nbsp;</p>
	
<?php
    break;
	case "addnew":
?>
	<div class="block full">
		<div class="block-title"><h2><?=$langabsen2;?></h2></div>
		<div class="table-responsive">
			<form method="post" action="<?=$aksi;?>">
				<input type="hidden" name="mod" value="absen">
				<input type="hidden" name="act" value="multidelete">
				<input type="hidden" value="0" name="totaldata" id="totaldata">
				<table cellpadding="0" cellspacing="0" border="0" class="dTableAjax table table-vcenter table-condensed table-bordered" id="dynamic">
					<thead><tr>
						<th>No.</th>
						<th>NIS</th>
						<th>Nama <?=$langmenu51;?></th>
						<th>JK</th>
						<th>Kelas</th>
						<th><?=$langmenu82;?></th>
					</tr></thead>
					<tbody></tbody>
				</table>
			</form>
		</div>
	</div>

<?php
    break;
}
}
?>