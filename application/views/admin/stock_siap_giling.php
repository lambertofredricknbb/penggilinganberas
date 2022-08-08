<?php 
date_default_timezone_set("Asia/Jakarta");
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
<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Stock Kering Giling</li>
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
          <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Stock Kering Giling</h3>
                    </div>
                    <div class="col text-right">
                        <?php if($user['level'] == 1): ?>
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#jual">
                        Jual Gabah KG
                      </button>

                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Beli Kering Giling
                      </button>
                      <?php endif ?>

                      <!-- modal jual -->
                      <div class="modal fade" id="jual" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Jual Beras Kering Giling</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="<?= base_url('admin/jual_kg') ?>" method="post">
                              <div class="modal-body text-left">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Nota Penjualan :</label>
                                      <input type="text" readonly="" class="form-control" name="nota_penjualan" id="nota_penjualan">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Nama Pembeli</label>
                                      <input type="text" class="form-control" name="pembeli">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="">Musim :</label>
                                      <select name="musim" class="form-control" id="">
                                        <option value="">-- Pilih Musim --</option>
                                        <option value="gaduan">Gaduan</option>
                                        <option value="rojoan">Rojoan</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Jenis :</label>
                                      <select name="jenis" class="form-control" id="">
                                        <option value="">-- Pilih Jenis --</option>
                                         <?php foreach ($jenis as $j): ?>
                                            <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                          <?php endforeach ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Grade :</label>
                                      <select name="grade" class="form-control" id="">
                                        <option value="">-- Pilih Grade --</option>
                                         <?php foreach ($grade as $g): ?>
                                            <option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>
                                          <?php endforeach ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="">Tonase :</label>
                                    <input type="text" class="form-control" name="tonase">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="">Harga :</label>
                                    <input type="text" class="form-control" name="harga">
                                  </div>
                                </div>
                              </div>
                              <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>


                    <!-- Modal Beli -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Pembelian Kering Giling</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?= base_url('admin/beli_kg') ?>" method="post">
                            <div class="modal-body text-left">
                              <input type="hidden" required="" name="id_user" value="<?= $user['id_user'] ?>">
                              <div class="row justify-content-left">
                                <div class="col-md-12 text-left">
                                  <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="">Kode Nota Otomatis</label>
                                            <input type="text" required="" class="form-control" readonly name="kode_pembelian" id="kode_pembelian">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="">Kode Nota <span style="color: red;">* Boleh Kosong</span></label>
                                            <?php
                                            $this->db->select('*');
                                            $this->db->from('tb_pembelian');
                                            $this->db->order_by('tb_pembelian.tanggal', 'DESC');
                                            $this->db->group_by('tb_pembelian.kode_pembelian');
                                            $result = $this->db->get()->result_array();
                                             ?>
                                            <select name="kode_nota" class="form-control" id="">
                                              <option value="">-- Pilih Nota -- </option>
                                              <?php foreach ($result as $r): ?>
                                                <option value="<?= $r['kode_pembelian'] ?>"><?= $r['kode_pembelian'] ?> -> <?= $r['nama_supplier'] ?></option>
                                              <?php endforeach ?>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="">Nama Supplier</label>
                                            <input type="text" required="" class="form-control" name="nama_supplier">
                                        </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <label for="">Nama Supir</label>
                                              <input type="text" required="" name="nama_supir" class="form-control">
                                          </div>
                                          <div class="col-md-6">
                                              <label for="">Plat Kendaraan</label>
                                              <input type="text" required="" name="plat" id="plat" class="form-control">
                                          </div>
                                      </div>
                                </div><hr>
                                <div class="form-group">
                                      <label for="">Nama Musim</label>
                                      <select name="musim" required="" class="form-control" id="">
                                        <option value="">-- Pilih Musim --</option>
                                        <option value="rojoan">Rojoan</option>
                                        <option value="gaduan">Gaduan</option>
                                      </select>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                  <label for="">Jenis Gabah</label>
                                  <select name="jenis_gabah" required="" class="form-control" id="">
                                      <option value="">-- Pilih Jenis --</option>
                                      <?php foreach ($jenis as $j): ?>
                                          <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>
                              <div class="col-md-2">
                                  <label for="">Grade</label>
                                  <select name="grade" required="" class="form-control" id="">
                                      <option value="">Pilih</option>
                                      <?php foreach ($grade as $g): ?>
                                          <option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>
                              <div class="col-md-3">
                                  <label for="">Tonase <span style="color: red;">(kg)</span></label>
                                  <input type="text" required="" class="form-control tonase" id="tonase" name="tonase">
                              </div>
                              <div class="col-md-3">
                                  <label for="">Harga /kg</label>
                                  <input type="text" required="" class="form-control" id="harga_kg" name="harga_kg">
                              </div>
                              <input type="hidden" required="" class="total" name="total" id="total">
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">Keterangan</label>
                                      <textarea name="keterangan" class="form-control"></textarea>
                                  </div>
                                </div><hr>
                              </div>
                              <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Stok Gabah Kering Giling!</strong> Hasil Pembelian dan Hasil Pengeringan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        </div>
                        <h1 class="text-center" style="font-weight: 800; color: #2980b9;">Total Stok Kering Giling</h1>
                        <?php
                          $this->db->select('SUM(tonase) as total_tonase');
                          $this->db->from('tb_stok_kg');
                        //   $this->db->where('tb_stok_kg.jenis', $j['id_jenis']);
                        //   $this->db->where('tb_stok_kg.grade', $g['id_grade']);
                          $tona = $this->db->get()->row()->total_tonase;
                        ?>
                        <span class="text-center align-center" style="font-weight: 800; font-size: 15pt; color: #2980b9;">Total : <?= ceil($tona) ?> Kg</span>
                        <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b>Grade</b></th>
                                <?php foreach ($jenis as $j): ?>
                                <th><b><?= $j['nama_jenis'] ?></b></th>
                                <?php endforeach ?>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($grade as $g): ?>
                                    <tr class="text-center">
                                        <td><b><?= $g['nama_grade'] ?></b></td>
                                        <?php foreach ($jenis as $j): ?>
                                        <?php
                                          $this->db->select('SUM(tonase) as total_tonase');
                                          $this->db->from('tb_stok_kg');
                                          $this->db->where('tb_stok_kg.jenis', $j['id_jenis']);
                                          $this->db->where('tb_stok_kg.grade', $g['id_grade']);
                                          $tona = $this->db->get()->row()->total_tonase;
                                        ?>

                                        <?php if ($tona != 0): ?>
                                            <td><?= ceil($tona) ?> Kg</td>
                                        <?php endif ?>
                                        <?php if ($tona == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </tr>                                 
                                <?php endforeach ?> 
                                <tr class="text-center" style="background-color: #ecf0f1;">
                                    <td><b>Total :</b></td>
                                    <?php foreach ($jenis as $j): ?>
                                        <?php
                                          $this->db->select('SUM(tonase) as total_tonase');
                                          $this->db->from('tb_stok_kg');
                                          $this->db->where('tb_stok_kg.jenis', $j['id_jenis']);
                                        //   $this->db->where('tb_stok_kg.grade', $g['id_grade']);
                                          $tona = $this->db->get()->row()->total_tonase;
                                        ?>

                                        <?php if ($tona != 0): ?>
                                            <td><b><?= ceil($tona) ?> Kg</b></td>
                                        <?php endif ?>
                                        <?php if ($tona == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                </tr>
                            </tbody>
                                
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row my-3">
                      
                      <div class="col-md-6">
                          <?php
                              $this->db->select('SUM(tonase) as total_tonase');
                              $this->db->from('tb_stok_kg');
                              $this->db->where('tb_stok_kg.musim', 'rojoan');
                              $tona = $this->db->get()->row()->total_tonase;
                            ?>
                        <?php if($tona != 0): ?>
                            <h1>Rojoan = <span style="color: #2ecc71;"><?= ceil($tona) ?> Kg</span></h1>
                        <?php endif; ?>
                        <?php if($tona == 0): ?>
                            <h1>Rojoan</h1>
                        <?php endif; ?>
                        <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b>Grade</b></th>
                                <?php foreach ($jenis as $j): ?>
                                <th><b><?= $j['nama_jenis'] ?></b></th>
                                <?php endforeach ?>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($grade as $g): ?>
                                    <tr class="text-center">
                                        <td><b><?= $g['nama_grade'] ?></b></td>
                                        <?php foreach ($jenis as $j): ?>
                                        <?php
                                          $this->db->select('SUM(tonase) as total_tonase');
                                          $this->db->from('tb_stok_kg');
                                          $this->db->where('tb_stok_kg.musim', 'rojoan');
                                          $this->db->where('tb_stok_kg.jenis', $j['id_jenis']);
                                          $this->db->where('tb_stok_kg.grade', $g['id_grade']);
                                          $tona = $this->db->get()->row()->total_tonase;
                                        ?>

                                        <?php if ($tona != 0): ?>
                                            <td><?= ceil($tona) ?> Kg</td>
                                        <?php endif ?>
                                        <?php if ($tona == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </tr>                                 
                                <?php endforeach ?>  
                                <tr class="text-center" style="background-color: #ecf0f1;">
                                    <td><b>Total :</b></td>
                                    <?php foreach ($jenis as $j): ?>
                                        <?php
                                          $this->db->select('SUM(tonase) as total_tonase');
                                          $this->db->from('tb_stok_kg');
                                          $this->db->where('tb_stok_kg.musim', 'rojoan');
                                          $this->db->where('tb_stok_kg.jenis', $j['id_jenis']);
                                          $tona = $this->db->get()->row()->total_tonase;
                                        ?>

                                        <?php if ($tona != 0): ?>
                                            <td><b><?= ceil($tona) ?> Kg</b></td>
                                        <?php endif ?>
                                        <?php if ($tona == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <?php
                              $this->db->select('SUM(tonase) as total_tonase');
                              $this->db->from('tb_stok_kg');
                              $this->db->where('tb_stok_kg.musim', 'gaduan');
                              $tona = $this->db->get()->row()->total_tonase;
                            ?>
                        <?php if($tona != 0): ?>
                            <h1>Gaduan = <span style="color: #2ecc71;"><?= ceil($tona) ?> Kg</span></h1>
                        <?php endif; ?>
                        <?php if($tona == 0): ?>
                            <h1>Gaduan</h1>
                        <?php endif; ?>
                    <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b>Grade</b></th>
                                <?php foreach ($jenis as $j): ?>
                                <th><b><?= $j['nama_jenis'] ?></b></th>
                                <?php endforeach ?>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($grade as $g): ?>
                                    <tr class="text-center">
                                        <td><b><?= $g['nama_grade'] ?></b></td>
                                        <?php foreach ($jenis as $j): ?>
                                        <?php
                                          $this->db->select('SUM(tonase) as total_tonase');
                                          $this->db->from('tb_stok_kg');
                                          $this->db->where('tb_stok_kg.musim', 'gaduan');
                                          $this->db->where('tb_stok_kg.jenis', $j['id_jenis']);
                                          $this->db->where('tb_stok_kg.grade', $g['id_grade']);
                                          $tona = $this->db->get()->row()->total_tonase;
                                        ?>

                                        <?php if ($tona != 0): ?>
                                            <td><?= ceil($tona) ?> Kg</td>
                                        <?php endif ?>
                                        <?php if ($tona == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </tr>                                 
                                <?php endforeach ?>
                                <tr class="text-center" style="background-color: #ecf0f1;">
                                    <td><b>Total :</b></td>
                                    <?php foreach ($jenis as $j): ?>
                                        <?php
                                          $this->db->select('SUM(tonase) as total_tonase');
                                          $this->db->from('tb_stok_kg');
                                          $this->db->where('tb_stok_kg.musim', 'gaduan');
                                          $this->db->where('tb_stok_kg.jenis', $j['id_jenis']);
                                        //   $this->db->where('tb_stok_kg.grade', $g['id_grade']);
                                          $tona = $this->db->get()->row()->total_tonase;
                                        ?>

                                        <?php if ($tona != 0): ?>
                                            <td><b><?= ceil($tona) ?> Kg</b></td>
                                        <?php endif ?>
                                        <?php if ($tona == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    
                    <hr>

                    <div class="row my-4">
                      <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Hasil Pembelian dan Penjualan!</strong> Pembelian dan Penjualan Gabah Kering Giling.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <h1>Penjualan</h1>
                        <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b>Nota</b></th>
                                <th><b>Pembeli</b></th>
                                <th><b>Uraian</b></th>
                                <th><b>Tonase</b></th>
                                <th><b>Harga Total</b></th>
                                <th><b>Tanggal</b></th>
                                <th><b>Aksi</b></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jual as $j): ?>           
                                  <tr class="text-center">
                                    <td><b><?= $j['nota_penjualan'] ?></b></td>
                                    <td><?= $j['pembeli'] ?></td>
                                    <td><b><?= $j['musim'] ?></b> <?= $j['nama_jenis'] ?> Grade (<?= $j['nama_grade'] ?>)</td>
                                    <td><?= $j['tonase'] ?> Kg</td>
                                    <td>Rp. <?= number_format($j['harga']*$j['tonase'], 0,'.','.') ?></td>
                                    <td><?= tgl_indo(date('Y-m-d', strtotime($j['tanggal']))) ?></td>
                                    <td><a href="<?= base_url('admin/cetak_jual_kg/').$j['nota_penjualan'] ?>" target="_blank" class="btn btn-success"><i class="fas fa fa-print"></i></a></td>
                                  </tr>                   
                                <?php endforeach ?>                             
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <h1>Pembelian</h1>
                    <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b>Nota</b></th>
                                <th><b>Penjual</b></th>
                                <th><b>Uraian</b></th>
                                <th><b>Tonase</b></th>
                                <th><b>Total</b></th>
                                <th><b>Tanggal</b></th>
                                <th><b>Aksi</b></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($beli as $b): ?>           
                                  <tr class="text-center">
                                    <td><b><?= $b['kode_pembelian'] ?></b></td>
                                    <td><?= $b['nama_supplier'] ?></td>
                                    <td><b><?= $b['musim'] ?></b> <?= $b['nama_jenis'] ?> Grade (<?= $b['nama_grade'] ?>)</td>
                                    <td><?= $b['tonase'] ?> Kg</td>
                                    <td>Rp. <?= number_format($b['total'], 0,'.','.') ?></td>
                                    <td><?= tgl_indo(date('Y-m-d'), strtotime($b['tanggal'])) ?></td>
                                    <td><a href="<?= base_url('admin/cetak_beli_kg/').$b['kode_pembelian'] ?>" target="_blank" class="btn btn-success"><i class="fas fa fa-print"></i></a></td>
                                  </tr>                   
                                <?php endforeach ?>                             
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    
                </div>
                
              </div>
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    // kode pembelian
    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>admin/getNotaJual',
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(data) {

                var html = JSON.parse(data);
                var kode = 'JKG_' + html;
                var nodaf = kode;
                $('#nota_penjualan').val(nodaf);
            }
        });
    });
    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>admin/getNotaBeli',
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(data) {

                var html = JSON.parse(data);
                var kode = 'BKG_' + html;
                var nodaf = kode;
                $('#kode_pembelian').val(nodaf);
            }
        });
    });
    $('#tonase').keyup(function(){
        var tonase = $('#tonase').val();
        var harga_kg = $('#harga_kg').val();
        var total = Number(tonase) * Number(harga_kg)
        $('#total').val(total);
    });
    $('#harga_kg').keyup(function(){
        var tonase = $('#tonase').val();
        var harga_kg = $('#harga_kg').val();
        var total = Number(tonase) * Number(harga_kg)
        $('#total').val(total);
    });
    // 
    $('.tonase').keyup(function(){
        var tonase = $('.tonase').val();
        // var items = new Array();
        // var total = 0;
        var result = 0
        // var id= "";
        // var kosong = "";

        for (var i = 0; i < 3 ; i++) {
            result += parseFloat(tonase[i]);
        }
        $('#total_kg').val(result);
    });

</script>