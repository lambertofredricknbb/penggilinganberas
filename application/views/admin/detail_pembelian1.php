    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Data Pembelian
                                        <div class="page-title-subheading">Data Pembelian Beras Yang Sudah Diterima
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>            
                        <div class="row justify-content-center">
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
                                                <div class="alert alert-primary text-center" role="alert">
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
                                                        <span><b>Kode Barang</b></span><br>
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
                                                    $result = $this->db->get();
                                                     ?>
                                                    <?php $i=1; foreach ($result->result_array() as $p): ?>
                                                    <tr>
                                                      <th class="text-center" scope="row"><?= $i ?></th>
                                                      <td><?= $p['nama_jenis'] ?> (GRADE <?= $p['nama_grade'] ?>)</td>
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
                                                          <th colspan="2" class="text-center">Total</th>
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
                                                <span><?= $d['keterangan'] ?></span>
                                            </div>
                                            <div class="col-md-3">
                                                <span>Dibuat Oleh</span>
                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <span style="font-weight: 500;"><?= $d['username'] ?></span>
                                                </div>
                                                <hr style="border-top: 1.5px solid black; margin-top: -1px;">
                                            </div>
                                            <div class="col-md-3">
                                                <span>Diterima Oleh</span>
                                                <br><br><br><br>
                                                <hr style="border-top: 1.5px solid black;">
                                            </div>
                                        </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    