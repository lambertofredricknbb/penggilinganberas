<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nota Pembelian Gabah KS</title>
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
		<span style="text-align: center; font-weight: 800; font-family: sans-serif;"><b>NOTA PEMBELIAN GABAH KS</b></span>
	</div><br>
	<?php foreach ($detail as $d): ?>
		<div class="row">
		  <div class="column">
		  	<div class="rowis">
		  		<div class="colom" style="width: 50%; float: left;">
		  			<span style="font-family: sans-serif;"><b>Tanggal Terima</b></span><br>
				  	<span style="font-family: sans-serif;"><b>Nama Supplier</b></span><br>
				  	<span style="font-family: sans-serif;"><b>No Kendaraan</b></span><br>
		  		</div>
		  		<div class="colom" style="width: 50%; float: left;">
		  			<?php 
                    	$tanggal_terima = date('Y-m-d', strtotime($d['tanggal']));
                    ?>
		  			<span style="font-family: sans-serif;">: <?= tgl_indo($tanggal_terima) ?></span><br>
				  	<span style="font-family: sans-serif;">: <?= $d['nama_supplier'] ?></span><br>
				  	<span style="font-family: sans-serif;">: <?= $d['plat'] ?></span><br>
		  		</div>
		  	</div>
		  </div>
		  <div class="column">
		  	<div class="rowis">
		  		<div class="colom" style="width: 50%; float: left;">
		  			<span><b></b></span><br>
				  	<span style="font-family: sans-serif;"><b>Kode Barang</b></span><br>
				  	<span style="font-family: sans-serif;"><b>Nama Barang</b></span><br>
		  		</div>
		  		<div class="colom" style="width: 50%; float: left;">
		  			<span></span><br>
				  	<span>: <span style="font-size: 12pt; font-family: sans-serif; font-weight: 800; color: #fbc531;"><b><?= $d['kode_pembelian'] ?></b></span></span><br>
				  	<span style="font-family: sans-serif;">: GABAH KS</span><br>
		  		</div>
		  	</div>
		  </div>
		</div>
		<br>

		<table id="customers">
		  <tr style="text-align: center;">
		    <th scope="col">No</th>
          <th scope="col">Nama Barang</th>
          <th scope="col">KA</th>
          <th scope="col">Tonase</th>
          <th scope="col">Harga / KG</th>
          <th scope="col">Total</th>
		  </tr>
		  <?php 
            $this->db->select('*');
            $this->db->from('tb_pembelian');
            $this->db->join('jenis_beras', 'tb_pembelian.jenis_gabah = jenis_beras.id_jenis');
            $this->db->join('grade', 'tb_pembelian.grade = grade.id_grade');
            $this->db->where('tb_pembelian.kode_pembelian', $d['kode_pembelian']);
            $this->db->where('tb_pembelian.tonase != 0');
            $result = $this->db->get();
          ?>
          <?php $i=1; foreach ($result->result_array() as $p): ?>
		  <tr style="text-align: center;">
		    <td style="text-align: center;"><?= $i ?></td>
		    <td><?= $p['nama_jenis'] ?> (GRADE <?= $p['nama_grade'] ?>)</td>
		    <td style="text-align: center;"><?= $p['ka'] ?>%</td>
		    <td style="text-align: center;"><?= $p['tonase'] ?> kg</td>
		    <td>Rp. <?= number_format($p['harga_kg'], 0,'.','.') ?></td>
            <td>Rp. <?= number_format($p['total'], 0,'.','.') ?></td>
		  </tr>
		  <?php $i++; endforeach ?>
		  <?php 
            $this->db->select('SUM(tonase) as total_tonase');
            $this->db->from('tb_pembelian');
            $this->db->where('tb_pembelian.kode_pembelian', $d['kode_pembelian']);
            $tonase = $this->db->get()->row()->total_tonase;

            $this->db->select('SUM(total) as total_harga');
            $this->db->from('tb_pembelian');
            $this->db->where('tb_pembelian.kode_pembelian', $d['kode_pembelian']);
            $total_harga = $this->db->get()->row()->total_harga;
             ?>
		  <tr>
		    <th style="text-align: center;" colspan="3"><b>Total</b></th>
		    <th style="text-align: left;" colspan="2"><b><?= $tonase ?> Kg</b></th>
		    <th colspan="1"><b>Rp. <?= number_format($total_harga, 0,'.','.') ?></b></th>
		  </tr>
		</table><br>
		<div class="rowet">
			<div class="col" style="width: 40%; float: left;">
				<h2>KETERANGAN</h2>
				<span style="margin-left: 10px;"><?= $d['keterangan'] ?></span>
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
				<span><?= $d['nama_supplier'] ?></span>
				<hr style="width: 80%;">
			</div>
		</div>
		<?php endforeach ?>
	

</body>
</html>