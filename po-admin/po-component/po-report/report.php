<?php

session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
$aksi="po-component/po-report/proses.php";
?>
	<div class="content-header">
		<div class="header-section"><h1><?=$langmenu90;?></h1></div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li><a href="admin.php?mod=home"><?=$langmenu1;?></a></li>
		<li><?=$langmenu90;?></li>
	</ul>
<?php
switch($_GET[act]){
	default:
?>
	<div class="block full">
		<div class="block-title"><h2><?= $langmenu90; ?> </h2></div>
		<form id="form-validation" class="form-bordered" method="post" action="<?=$aksi;?>" autocomplete="off">
            <fieldset>
				<input type="hidden" name="mod" value="report">
				<input type="hidden" name="act" value="view_report">
				<div class="form-group">
					<label>No. Induk Siswa <span class="text-danger">*</span></label>
					<?php
					$tablecats = new PoTable("absen");
					$cats = $tablecats->findAll(id_siswa, ASC);
					$numcats = $tablecats->numRow();
					if ($numcats > 0){
						echo "<select class='select-chosen' name='id_siswa' style='width:280px;' data-placeholder='Choose a Category'>";
						foreach($cats as $cat){
							echo "<option value='$cat->id_siswa'>$cat->id_siswa</option>";
						}
						echo "</select>";
					}
					?>
				</div>
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
		<div class="block-title"><h2><?=$langmenu90;?></h2></div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No.</th>
						<th>NIS</th>
						<th>Kelas</th>
						<th>Keterangan</th>
						<th>Jam</th>
						<th>Tanggal</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$id_siswa = $_SESSION['id_siswa'];
				$tablecats = new PoTable("absen");
				$cats = $tablecats->findBy(id_siswa,$id_siswa);
				$numcats = $tablecats->numRow();
				$no = 1;
					if ($numcats > 0){
						foreach($cats as $cat){
							echo "<tr><td>$no</td>";
							echo "<td> $cat->id_siswa </td>";
							echo "<td> $cat->kelas </td>";
							echo "<td> $cat->ket </td>";
							echo "<td> $cat->jam </td>";
							echo "<td> $cat->tgl </td></tr>";
							$no++;
						}
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
<?php
    break;
}
}
?>