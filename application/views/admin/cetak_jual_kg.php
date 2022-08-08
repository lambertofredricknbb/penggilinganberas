<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nota Penjualan Gabah KS</title>
	<style>
		.alert {
		  height: 10px;
		  background-color: #4cd137;
		  color: white;
		}
		/*colom*/
		.column {
		  float: left;
		  width: 50%;
		}
		.kolom1 {
			float: left;
		  	width: 20%;
		}
		.kolom2 {
			float: left;
		  	width: 80%;
		}
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}
		.rowed:after {
		  content: "";
		  display: table;
		  clear: both;
		}
		.rowet:after {
		  content: "";
		  display: table;
		  clear: both;
		}
		/*table*/
		#customers {
		  font-family: Arial, Helvetica, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}

		#customers td, #customers th {
		  border: 1px solid #ddd;
		  padding: 8px;
		}

		#customers tr:nth-child(even){background-color: #f2f2f2;}

		#customers tr:hover {background-color: #ddd;}

		#customers th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  /*text-align: center;*/
		  background-color: #04AA6D;
		  color: white;
		}
		/*box*/
		.box {
		  width: 100%;
		  /*height: 1px;*/
		  text-align: center;
		  padding: 2px;
		  border: 2px solid blue;
		}
	</style>
	<?php 
    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
     ?>
</head>
<body>
	<div class="rowed">
		<div class="kolom1"><img src="<?= base_url('assets/logo-srs.png') ?>" style="width: 90%; margin-top: 10px;" alt=""></div>
		<div class="kolom2">
			<span style="font-size: 20pt; font-weight: 850; font-family: sans-serif; margin-top: 20px;"><b>UD SUMBER REJEKI SEJATI</b></span><br>
			<span style="font-weight: 600; font-size: 12pt; margin-top: -100px;">Jln. Sumanto, Balung Kidul, Jember</span>
		</div>
	</div><br>
	<div class="box">
		<span style="text-align: center; font-weight: 800; font-family: sans-serif;"><b>NOTA PENJUALAN BERAS</b></span>
	</div><br>
	<?php $i=1; foreach ($detail as $d): ?>
		<div class="row">
		  <div class="column">
		  	<div class="rowis">
		  		<div class="colom" style="width: 50%; float: left;">
		  			<span style="font-family: sans-serif;"><b>Tanggal Terima</b></span><br>
				  	<span style="font-family: sans-serif;"><b>Nama Pembeli</b></span><br>
		  		</div>
		  		<div class="colom" style="width: 50%; float: left;">
		  			<?php 
                    	$tanggal = date('Y-m-d', strtotime($d['tanggal']));
                    ?>
		  			<span style="font-family: sans-serif;">: <?= tgl_indo($tanggal) ?></span><br>
				  	<span style="font-family: sans-serif;">: <?= $d['pembeli'] ?></span><br>
		  		</div>
		  	</div>
		  </div>
		  <div class="column">
		  	<div class="rowis">
		  		<div class="colom" style="width: 50%; float: left;">
				  	<span style="font-family: sans-serif;"><b>Kode Penjualan</b></span><br>
				  	<span style="font-family: sans-serif;"><b>Nama Barang</b></span><br>
		  		</div>
		  		<div class="colom" style="width: 50%; float: left;">
				  	<span>: <span style="font-size: 12pt; font-family: sans-serif; font-weight: 800; color: #fbc531;"><b><?= $d['nota_penjualan'] ?></b></span></span><br>
				  	<span style="font-family: sans-serif;">: Gabah Kg</span><br>
		  		</div>
		  	</div>
		  </div>
		</div>
		<br>

		<table id="customers">
		  <tr style="text-align: center;">
		    <th><b>No.</b></th>
		    <th><b>Uraian Barang</b></th>
		    <th><b>Tonase</b></th>
		     <th><b>Harga / Kg</b></th> 
		    <th><b>Total</b></th>
		  </tr>
		  <tr style="text-align: center;">
		    <td style="text-align: center;"><?= $i ?></td>
		    <td><?= $d['musim'] ?> </b> <?= $d['nama_jenis'] ?> (GRADE <?= $d['nama_grade'] ?>)</td>
		    <td style="text-align: center;"><?= $d['tonase'] ?> kg</td>
		    <td>Rp. <?= number_format($d['harga'], 0,'.','.') ?></td>
		    <td>Rp. <?= number_format($d['harga'] * $d['tonase'], 0,'.','.') ?></td>
		  </tr>
		  <tr>
		    <th style="text-align: center;" colspan="2"><b>Total</b></th>
		    <th style="text-align: left;" colspan="1"><b><?= $d['tonase'] ?> Kg</b></th>
		    <th colspan="1"><b>Rp. <?= number_format($d['harga'], 0,'.','.') ?></b></th>
		    <th colspan="1"><b>Rp. <?= number_format($d['harga'] * $d['tonase'], 0,'.','.') ?></b></th>
		  </tr>
		</table><br>
		<div class="rowet">
			<div class="col" style="width: 40%; float: left;">
				<h2>KETERANGAN</h2>
				<span style="margin-left: 10px;">-</span>
			</div>
			<div class="col" style="width: 30%; float: left; text-align: center;">
				<h6 style="font-weight: 800; font-size: 10pt;"><b>DIBUAT OLEH :</b></h6>
				<br><br>
				<span><?= $d['username'] ?></span>
				<hr style="width: 80%;">
			</div>
			<div class="col" style="width: 30%; text-align: center; float: left;">
				<h6 style="font-weight: 800; font-size: 10pt;"><b>DITERIMA OLEH</b></h6>
				<br><br>
				<span><?= $d['nama_pembeli'] ?></span>
				<hr style="width: 80%;">
			</div>
		</div>
		<?php $i++; endforeach ?>
	

</body>
</html>