<?php
	header('Access-Control-Allow-Origin: http://kepegawaian.ub.ac.id');
	
	$param_pendaftar['IS_DOSEN'] = (isset($_REQUEST['IS_DOSEN'])) ? $_REQUEST['IS_DOSEN'] : 'x';
	$param_pendaftar['NO_PESERTA'] = (isset($_REQUEST['NO_PESERTA'])) ? $_REQUEST['NO_PESERTA'] : 'x';
	$array_pendaftar = $this->lseleksi_dosen->get_array_pendaftar($param_pendaftar);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<?php if (count($array_pendaftar) > 0) { ?>
<table id="IdTablePeserta">
<thead>
<tr>          												                       
	<th class="normal" style="width: 125px;">No.Peserta</td>
	<th class="normal" style="width: 250px;">Nama</td>                                                
	<th class="normal" style="width: 125px;">Jenjang</td>
	<th class="normal" style="width: 100px;">Kualifikasi</td>
	<th class="normal" style="width: 100px;">Pilihan Pelamar</td>                                                                                                
	<th class="normal" style="width: 100px;">Cetak</td></tr>
</thead>
<tbody>
<?php foreach ($array_pendaftar as $row) { ?>
<tr>                                   
	<td ><?php echo $row['NO_PESERTA']; ?></td>
	<td ><?php echo $row['NAMA']; ?></td>                                                                                                      		
	<td ><?php echo $row['JENJANG']; ?></td>
	<td ><?php echo $row['KUALIFIKASI_PEND']; ?></td>
	<td ><?php echo $row['PILIHAN']; ?></td>                   
	<td ><a href="<?php echo $row['LINK_CETAK']; ?>" target="_blank">Tanda Peserta</a></td></tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
</body>
</html>