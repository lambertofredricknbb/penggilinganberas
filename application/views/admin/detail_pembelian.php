<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row py-4">
            <div class="col-md-4">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Admin</li>
                </ol>
              </nav>
            </div>
            <div class="col-md-2">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <?php foreach ($detail as $d): ?>
                      <li class="breadcrumb-item"><a target="_blank" href="<?= base_url('admin/cetakPembelian/').$d['kode_pembelian'] ?>"><i class="fas fa fa-print"></i></a></li>
                        <?php endforeach ?>
                    </ol>
                  </nav>
            </div>
          </div>
          <!-- Card stats -->
          <div class="row justify-content-center">
            
            <div class="col-md-12">
                
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
            <div class="card-body">
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
                <?php foreach ($detail as $d): ?>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success text-center" role="alert">
                          <b>NOTA PEMBELIAN BARANG</b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span><b>Tanggal Terima</b></span><br>
                                <span><b>Nama Supplier</b></span><br>
                                <span><b>Kendaraan</b></span><br>
                            </div>
                            <div class="col-md-6">
                                <?php 
                                $tanggal_terima = date('Y-m-d', strtotime($d['tanggal']));
                                 ?>
                                <span>: <?= tgl_indo($tanggal_terima) ?></span><br>
                                <span>: <?= $d['nama_supplier'] ?></span><br>
                                <span>: <?= $d['nama_supir'] ?> / <?= $d['plat'] ?></span><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span><b>No Nota</b></span><br>
                                <span><b>Nama Barang</b></span><br>
                            </div>
                            <div class="col-md-6">
                                : <span style="font-weight:  700; color: #f1c40f; "> <?= $d['kode_pembelian'] ?></span><br>
                                <span>: </span><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr class="text-center">
                              <th scope="col">No</th>
                              <th scope="col">Nama Barang</th>
                              <th scope="col">KA</th>
                              <th scope="col">Tonase</th>
                              <th scope="col">Harga / KG</th>
                              <th scope="col">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- format tanggal -->

                             <!-- tabel -->
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
                            <tr>
                              <th class="text-center" scope="row"><?= $i ?></th>
                              <td><?= $p['nama_jenis'] ?> (GRADE <?= $p['nama_grade'] ?>)</td>
                              <td class="text-center"><?= $p['ka'] ?>%</td>
                              <td><?= $p['tonase'] ?> kg</td>
                              <td>Rp. <?= number_format($p['harga_kg'], 0,'.','.') ?></td>
                              <td>Rp. <?= number_format($p['total'], 0,'.','.') ?></td>
                            </tr>
                            <?php $i++; endforeach ?>
                          </tbody>
                          <tfoot>
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
                                  <th colspan="3" class="text-center">Total</th>
                                  <th class="text-right"><?= $tonase ?> Kg</th>
                                  <th colspan="2" class="text-right">Rp. <?= number_format($total_harga, 0,'.','.') ?></th>
                              </tr>
                          </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span><b>KETERANGAN :</b></span>
                        <br>
                        <span style="margin-left: 20px;"><?= $d['keterangan'] ?></span>
                    </div>
                    <div class="col-md-3">
                        <span>Dibuat Oleh :</span>
                        <br><br><br><br>
                        <div class="text-center">
                            <span style="font-weight: 500;"><?= $d['username'] ?></span>
                        </div>
                        <hr style="border-top: 1.5px solid black; margin-top: -1px;">
                    </div>
                    <div class="col-md-3">
                        <span>Diterima Oleh :</span>
                        <br><br><br><br>
                        <span style="margin-top: 20px;"></span>
                        <hr style="border-top: 1.5px solid black; margin-top: 20px;">
                    </div>
                </div>
                <?php endforeach ?>

            </div>
        </div>
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>