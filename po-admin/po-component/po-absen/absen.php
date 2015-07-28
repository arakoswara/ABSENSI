<?php
date_default_timezone_set('Asia/Jakarta');
$tglsekarang = date("d-m-Y h:i:s");

session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
$aksi="po-component/po-absen/proses.php";
?>
	<div class="content-header">
		<div class="header-section"><h1><?=$langabsen2;?><?php echo " | Jam Pelajaran Ke - ". $jam = $_SESSION['jam'];?></h1></div>
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
		<div class="block-title"><h2>Tambah Absensi | <?php echo $tglsekarang; ?> </h2></div>
		<form id="form-validation" class="form-bordered" method="post" action="<?=$aksi;?>" autocomplete="off">
            <fieldset>
				<input type="hidden" name="mod" value="absen">
				<input type="hidden" name="act" value="view_data">
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

			<?php
			$idk = $_SESSION['idk'];
			$tablecats = new PoTable("siswa");
			$cats = $tablecats->findBy(idk, $idk);
			$numcats = $tablecats->numRow();
			?>

			<form method="post" action="<?=$aksi;?>">
				<input type="hidden" name="mod" value="absen">
				<input type="hidden" name="act" value="input">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-vcenter table-condensed table-bordered">
					<thead><tr>
						<th>No.</th>
						<th>NIS</th>
						<th>Nama <?=$langmenu51;?></th>
						<th>JK</th>
						<th>Kelas</th>
						<th><?=$langmenu82;?></th>
					</tr>
					</thead>
					<tbody>
					
					<?php
					if ($numcats > 0){
						$no =0;
						foreach($cats as $cat){
							echo "<tr><td>$no</td>";
							echo "<td>".$cat->nis."</td>";
							echo "<td>".$cat->nama."</td>";
							echo "<td>".$cat->jk."</td>";
							echo "<td>".$cat->idk."</td>";
							echo "<td>
									<input name='ket[$no]' type='radio' value='H'> H
									<input name='ket[$no]' type='radio' value='I'> I
									<input name='ket[$no]' type='radio' value='S'> S
									<input name='ket[$no]' type='radio' value='A'> A

									<input type='hidden' name='id_siswa[]' value='$cat->nis'>
									<input type='hidden' name='kelas[]' value='$cat->idk'>
									<input type='hidden' name='tgl[]' value='$tglsekarang'>
									<input type='hidden' name='jam[]' value='$jam'>

								  </td></tr>";
							$no++;
						}
					}
					?>					
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6">
								<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Simpan Data</button>
							</td>
						</tr>
					</tfoot>	
				</table>
			</form>
		</div>
	</div>
<?php
    break;
}
}
?>