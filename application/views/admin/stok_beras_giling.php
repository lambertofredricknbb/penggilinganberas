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
<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Hasil Penggilingan Gabah</li>
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
                      <h3 class="mb-0">Stok Beras Giling</h3>
                    </div>
                    <div class="col text-right">
                        <?php if($user['level'] == 1): ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#jual">
                          <i class="fas fa fa-plus"></i> Jual Beras
                        </button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#beli">
                          <i class="fas fa fa-dollar-sign"></i> Beli Beras
                        </button>
                        <?php endif; ?>
                        <!-- beli -->
                        <div class="modal fade" id="beli" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Pembelian Beras Giling</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="<?= base_url('admin/beli_beras') ?>" method="post">
                                <div class="modal-body text-left">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label for="">Nota Pembelian</label>
                                      <input type="text" readonly="" name="nota_pembelian" id="nota_pembelian" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="">Nama Supplier</label>
                                      <input required="" type="text" name="nama_supplier" class="form-control">
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4">
                                      <label for="">Musim</label>
                                      <select required="" name="musim" class="form-control" id="">
                                        <option value="">-- Pilih --</option>
                                        <option value="gaduan">Gaduan</option>
                                        <option value="rojoan">Rojoan</option>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <label for="">Jenis</label>
                                      <select required="" name="jenis" class="form-control" id="">
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($jenis as $j): ?>
                                          <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <label for="">Grade</label>
                                      <select required="" name="grade" class="form-control" id="">
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($grade as $g): ?>
                                          <option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label for="">Tonase Beras</label>
                                      <input type="text" required="" name="tonase_beras" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="">Harga Total</label>
                                      <input type="text" required="" name="harga" class="form-control">
                                    </div>
                                  </div>
                                  <input type="hidden" required="" name="id_user" value="<?= $user['id_user'] ?>">
                                  <input type="hidden" required="" name="tanggal" value="<?= date('Y-m-d H:i:s') ?>">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Beli</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <!-- jual -->
                        <div class="modal fade" id="jual" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Jual Beras Hasil Giling</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="<?= base_url('admin/add_jual_beras') ?>" method="post">
                                <div class="modal-body text-left">
                                  <div class="form-group">
                                    <label for="">Kode Penjualan :</label>
                                    <input type="text" required="" id="kode_penjualan" readonly="" class="form-control" name="kode_penjualan">
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="">Musim :</label>
                                        <select required="" name="musim" class="form-control" id="musim">
                                          <option value="">-- Pilih --</option>
                                          <?php
                                          $this->db->select('*');
                                          $this->db->from('tb_stok_proses_giling');
                                        //   $this->db->where('tb_stok_proses_giling.hasil_beras > 0');
                                          $this->db->group_by('tb_stok_proses_giling.musim');
                                          $musim = $this->db->get()->result_array();
                                          ?>
                                          <?php foreach ($musim as $m): ?>
                                            <option value="<?= $m['musim'] ?>"><?= $m['musim'] ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>  
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="">Jenis Gabah :</label>
                                        <select required="" name="jenis" class="form-control" id="jenis">
                                          <option value="">-- Pilih --</option>
                                          <?php
                                          $this->db->select('*');
                                          $this->db->from('tb_stok_proses_giling');
                                          $this->db->join('jenis_beras','tb_stok_proses_giling.jenis = jenis_beras.id_jenis');
                                          $this->db->group_by('tb_stok_proses_giling.jenis');
                                          
                                        //   $this->db->where('tb_stok_proses_giling.hasil_beras > 0');
                                        //   $this->db->order_by('tb_stok_proses_giling.tanggal', 'DESC');
                                          $jenis = $this->db->get()->result_array();
                                          ?>
                                          <?php foreach ($jenis as $je): ?>
                                            <option value="<?= $je['id_jenis'] ?>"><?= $je['nama_jenis'] ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>  
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="">Grade :</label>
                                        <select required="" name="grade" class="form-control" id="grade">
                                          <option value="">-- Pilih --</option>
                                          <?php
                                          $this->db->select('*');
                                          $this->db->from('tb_stok_proses_giling');
                                          $this->db->join('grade','tb_stok_proses_giling.grade = grade.id_grade');
                                          $this->db->group_by('tb_stok_proses_giling.grade');
                                          $this->db->order_by('tb_stok_proses_giling.tanggal', 'DESC');
                                        //   $this->db->where('tb_stok_proses_giling.hasil_beras > 0');
                                          $grade = $this->db->get()->result_array();
                                          ?>
                                          <?php foreach ($grade as $gr): ?>
                                            <option value="<?= $gr['id_grade'] ?>"><?= $gr['nama_grade'] ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>  
                                    </div>
                                  </div> 
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Tonase Beras :</label>
                                        <input required="" type="text" class="form-control" name="tonase_beras">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Total Harga :</label>
                                        <input required="" type="text" class="form-control" name="total">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="">Pembeli :</label>
                                    <input type="text" required="" name="nama_pembeli" class="form-control">
                                  </div>
                                </div>
                                <input type="hidden" name="tanggal" value="<?= date('Y-m-d H:i:s') ?>">
                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Jual</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                    </div>
                  </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                            <div class="col-md-4 text-center">
                                <?php
                                  $this->db->select('SUM(hasil_beras) as beras');
                                  $this->db->from('tb_stok_proses_giling');
                                  $hberas = $this->db->get()->row()->beras;
                                ?>
                                <b>Total Beras : </b> <b><?= $hberas ?> Kg</b>
                            </div>
                            <div class="col-md-4 text-center">
                                <?php
                                  $this->db->select('SUM(hasil_menir) as menir');
                                  $this->db->from('tb_stok_proses_giling');
                                  $hmenir = $this->db->get()->row()->menir;
                                ?>
                                <b>Total Menir : </b> <b><?= $hmenir ?> Kg</b>
                            </div>
                            <div class="col-md-4 text-center">
                                <?php
                                  $this->db->select('SUM(hasil_katul) as katul');
                                  $this->db->from('tb_stok_proses_giling');
                                  $hkatul = $this->db->get()->row()->katul;
                                ?>
                                <b>Total Katul : </b> <b><?= $hkatul ?> Kg</b>
                            </div>
                    </div>
                </div><hr>
                <div class="row justify-content-center">
                      <div class="col-md-12">
                        <h1 class="text-center" style="font-weight: 800; color: #2980b9;">Total Stok Beras Hasil Giling</h1>
                        <?php
                          $this->db->select('SUM(hasil_beras) as hasil_beras');
                          $this->db->from('tb_stok_proses_giling');
                          $tona = $this->db->get()->row()->hasil_beras;

                        ?>
                        <b style="margin-left: 5%; font-weight: 800;">Total : </b><b style="color: #2c3e50; font-weight: 800;"><?= ceil($tona) ?> Kg</b><br><br>
                        <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b>Grade</b></th>
                                <?php foreach ($this->db->get('jenis_beras')->result_array() as $jen): ?>
                                <th><b><?= $jen['nama_jenis'] ?></b></th>
                                <?php endforeach ?>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->db->get('grade')->result_array() as $gra): ?>
                                    <tr class="text-center">
                                        <td><b><?= $gra['nama_grade'] ?></b></td>
                                        <?php foreach ($this->db->get('jenis_beras')->result_array() as $je): ?>
                                        <?php
                                          $this->db->select('SUM(hasil_beras) as total_beras');
                                          $this->db->from('tb_stok_proses_giling');
                                          $this->db->where('tb_stok_proses_giling.jenis', $je['id_jenis']);
                                          $this->db->where('tb_stok_proses_giling.grade', $gra['id_grade']);
                                          $tona = $this->db->get()->row()->total_beras;                                         
                                        ?>

                                        <?php if ($tona != 0): ?>
                                            <td><?= $tona ?> Kg</td>
                                        <?php endif ?>
                                        <?php if ($tona == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </tr>                                 
                                <?php endforeach ?>   
                                    <tr class="text-center" style="background-color: #ecf0f1;">
                                        <td><b>Total</b></td>
                                        <?php foreach ($this->db->get('jenis_beras')->result_array() as $j): ?>
                                        <?php
                                          $this->db->select('SUM(hasil_beras) as total_beras');
                                          $this->db->from('tb_stok_proses_giling');
                                          $this->db->where('tb_stok_proses_giling.jenis', $j['id_jenis']);
                                          $tona = $this->db->get()->row()->total_beras;
                                        ?>

                                        <?php if ($tona != 0): ?>
                                            <td><b style="color: #3498db;"><?= $tona ?> Kg</b></td>
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
                    </div><hr>
                <div class="row justify-content-center">
                  <div class="col-md-10 text-center">
                    <h1 class="badge badge-pill badge-primary" style="font-size: 20pt;">Data Penjualan Beras Giling</h1>
                  </div>
                </div>
                <div class="table-responsive">
                  <!-- Projects table -->

                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th><b>No.</b></th>
                        <th><b>Nota Penjualan</b></th>
                        <th><b>User</b></th>
                        <th><b>Nama Pembeli</b></th>
                        <th><b>Tonase Beras</b></th>
                        <th><b>Tanggal</b></th>
                        <th><b>Aksi</b></th>
                        <!-- <th><b>Aksi</b></th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($jual_beras as $j): ?>
                          <tr class="text-center">
                            <td><?= $i; ?></td>
                            <td><?= $j['kode_penjualan'] ?></td>
                            <td><?= $j['username'] ?></td>
                            <td><?= $j['nama_pembeli'] ?></td>
                            <td><?= $j['tonase_beras'] ?> Kg</td>
                            <td><?= tgl_indo(date('Y-m-d'), $j['tanggal']) ?></td>
                            <td>
                              <a target="_blank" href="<?= base_url('admin/cetak_jual_beras/').$j['kode_penjualan'] ?>" class="btn btn-success"><i class="fas fa fa-print"></i></a>
                            </td>

                          </tr>                       
                        <?php $i++; endforeach ?>
                    </tbody>
                  </table>
                </div>
                <br><br><hr>  
                <div class="row justify-content-center">
                  <div class="col-md-10 text-center">
                    <h1 class="badge badge-pill badge-primary" style="font-size: 20pt;">Data Pembelian Beras Giling</h1>
                  </div>
                </div>  
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th><b>No.</b></th>
                        <th><b>Nota Pembelian</b></th>
                        <th><b>User</b></th>
                        <th><b>Uraian</b></th>
                        <th><b>Nama Supplier</b></th>
                        <th><b>Tanggal</b></th>
                        <th><b>Aksi</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($beli_beras as $b): ?>
                          <tr class="text-center">
                            <td><?= $i; ?></td>
                            <td><?= $b['kode_pembelian'] ?></td>
                            <td><?= $b['username'] ?></td>
                            <td><b><?= $b['musim'] ?></b>. <?= $b['nama_jenis'] ?> (<b><?= $b['nama_grade'] ?></b>) = <?= $b['tonase_beras'] ?>Kg</td>
                            <td><?= $b['nama_supplier'] ?></td>
                            <td><?= tgl_indo(date('Y-m-d'), $j['tanggal']) ?></td>
                            <td>
                              <a target="_blank" class="btn btn-success" href="<?= base_url('admin/cetak_beli_beras/').$b['kode_pembelian'] ?>"><i class="fas fa fa-print"></i></a>
                            </td>

                          </tr>                       
                        <?php $i++; endforeach ?>
                    </tbody>
                  </table>
                </div><br>  <br>  
              </div>
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>admin/getKodeKebi',
                beforeSend: function() {
                    $('.loading').show();
                },
                success: function(data) {

                    var html = JSON.parse(data);
                    var kode = 'KEBI_' + html;
                    var nodaf = kode;
                    $('#kode_kebi').val(nodaf);
                }
            });

            // 
            $("#beras_50").keyup(function () {
              var beras = $("#berate").val()
              var b5 = $("#beras_5").val();
              var b10 = $("#beras_10").val();
              var b25 = $("#beras_25").val();
              var b50 = $("#beras_50").val();
              var totall = Number(b5) + Number(b10) + Number(b25) + Number(b50);
              console.log(totall);
              if (totall > beras) {
                alert('Berat tidak boleh melebihi beras yang dimasukkan');
                // $("#beras_50").val(beras / 4);
              }
            });
            $("#beras_25").keyup(function () {
              var beras = $("#berate").val()
              var b5 = $("#beras_5").val();
              var b10 = $("#beras_10").val();
              var b25 = $("#beras_25").val();
              var b50 = $("#beras_50").val();
              var totall = Number(b5) + Number(b10) + Number(b25) + Number(b50);
              console.log(totall);
              if (totall > beras) {
                alert('Berat tidak boleh melebihi beras yang dimasukkan');
                // $("#beras_25").val(beras / 4);
              }
            });
            $("#beras_10").keyup(function () {
              var beras = $("#berate").val()
              var b5 = $("#beras_5").val();
              var b10 = $("#beras_10").val();
              var b25 = $("#beras_25").val();
              var b50 = $("#beras_50").val();
              var totall = Number(b5) + Number(b10) + Number(b25) + Number(b50);
              console.log(totall);
              if (totall > beras) {
                alert('Berat tidak boleh melebihi beras yang dimasukkan');
                // $("#beras_10").val(beras / 4);
              }
            });
            $("#beras_5").keyup(function () {
              var beras = $("#berate").val()
              var b5 = $("#beras_5").val();
              var b10 = $("#beras_10").val();
              var b25 = $("#beras_25").val();
              var b50 = $("#beras_50").val();
              var totall = Number(b5) + Number(b10) + Number(b25) + Number(b50);
              console.log(totall);
              if (totall > beras) {
                alert('Berat tidak boleh melebihi beras yang dimasukkan');
                // $("#beras_5").val(beras / 4);
              }
            });


        });

            $(document).ready(function() {
              $.ajax({
                  type: 'GET',
                  url: '<?php echo base_url(); ?>admin/getKodeJual',
                  beforeSend: function() {
                      $('.loading').show();
                  },
                  success: function(data) {

                      var html = JSON.parse(data);
                      var kode = 'JBG_' + html;
                      var nodaf = kode;
                      $('#kode_penjualan').val(nodaf);
                  }
              });
          });

          $(document).ready(function() {
              $.ajax({
                  type: 'GET',
                  url: '<?php echo base_url(); ?>admin/getKodeBeliBeras',
                  beforeSend: function() {
                      $('.loading').show();
                  },
                  success: function(data) {

                      var html = JSON.parse(data);
                      var kode = 'BBG_' + html;
                      var nodaf = kode;
                      $('#nota_pembelian').val(nodaf);
                  }
              });
          });


        </script>