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
                  <li class="breadcrumb-item active" aria-current="page">Stock Kering Sawah</li>
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
                    <div class="col-md-6">
                      <h3 class="mb-0">Stock Kering Sawah</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <!--<a class="btn btn-primary text-white align-right" data-toggle="modal" data-target="#jualgabah"><i class="fas fa fa-plus"></i> Jual Gabah KS</a>-->
                    </div>
                  </div>
                </div>
                <!--modal-->
                <div class="modal fade" id="jualgabah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="<?= base_url('admin/jual_ks') ?>" method="post">
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Kode Jual :</label>
                                        <input type="text" readonly="" id="kode_jual" class="form-control" name="kode_jual">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Pembeli :</label>
                                        <input type="text" class="form-control" name="nama_pembeli">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Musim :</label>
                                    <select name="musim" class="form-control" id="">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                          $this->db->select('*');
                                          $this->db->from('tb_stok_ks');
                                          $this->db->join('jenis_beras', 'tb_stok_ks.jenis = jenis_beras.id_jenis');
                                          $this->db->join('grade', 'tb_stok_ks.grade = grade.id_grade');
                                          // $this->db->group_by('tb_stok_kg.jenis');
                                          $this->db->where('tb_stok_ks.tonase > 0');
                                          $this->db->group_by('tb_stok_ks.musim');
                                          $musima = $this->db->get()->result_array();
                                        ?>
                                         <?php foreach ($musima as $m): ?>
                                            <option value="<?= $m['musim'] ?>"><?= $m['musim'] ?></option>
                                          <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Jenis :</label>
                                    <select name="jenis" class="form-control" id="">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                          $this->db->select('*');
                                          $this->db->from('tb_stok_ks');
                                          $this->db->join('jenis_beras', 'tb_stok_ks.jenis = jenis_beras.id_jenis');
                                          $this->db->join('grade', 'tb_stok_ks.grade = grade.id_grade');
                                          $this->db->group_by('tb_stok_ks.jenis');
                                          $this->db->where('tb_stok_ks.tonase > 0');
                                          // $this->db->group_by('tb_stok_kg.grade');
                                          $this->db->order_by('tb_stok_ks.tanggal', 'DESC');
                                        $jenisa = $this->db->get()->result_array();
                                        ?>
                                        <?php foreach ($jenisa as $j): ?>
                                            <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Grade :</label>
                                    <select name="grade" class="form-control" id="">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                          $this->db->select('*');
                                          $this->db->from('tb_stok_ks');
                                          $this->db->join('jenis_beras', 'tb_stok_ks.jenis = jenis_beras.id_jenis');
                                          $this->db->join('grade', 'tb_stok_ks.grade = grade.id_grade');
                                          // $this->db->group_by('tb_stok_kg.jenis');
                                          $this->db->group_by('tb_stok_ks.grade');
                                          $this->db->order_by('tb_stok_ks.tanggal', 'DESC');
                                          $this->db->where('tb_stok_ks.tonase > 0');
                                          $gradea = $this->db->get()->result_array();
                                          ?>
                                        <?php foreach ($gradea as $g): ?>
                                            <option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tonase :</label>
                                        <input type="text" class="form-control" name="tonase">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Total Harga :</label>
                                        <input type="text" class="form-control" name="total_harga">
                                    </div>
                                </div>
                            </div>
                          </div>
                          <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Jual</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--endmodal-->
                <div class="card-body">
                    <div class="row">
                        <?php
                          $this->db->select('SUM(tonase) as total_tonase');
                          $this->db->from('tb_pengeringan');
                          $tona = $this->db->get()->row()->total_tonase;
                        ?>
                      <div class="col-md-12">
                          <span style="color: #f39c12; font-weight: 600;">Total Gabah KS : <?= $tona ?> Kg</span><br><br>
                      </div>
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b style="font-weight: 900;">Grade</b></th>
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
                                          $this->db->from('tb_pengeringan');
                                          // $this->db->where('tb_pengeringan.musim', 'rojoan');
                                          $this->db->where('tb_pengeringan.jenis_gabah', $j['id_jenis']);
                                          $this->db->where('tb_pengeringan.grade', $g['id_grade']);
                                          $tona = $this->db->get()->row()->total_tonase;
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
                                        <?php foreach ($jenis as $j): ?>
                                        <?php
                                          $this->db->select('SUM(tonase) as total_tonase');
                                          $this->db->from('tb_pengeringan');
                                          // $this->db->where('tb_pengeringan.musim', 'rojoan');
                                          $this->db->where('tb_pengeringan.jenis_gabah', $j['id_jenis']);
                                        //   $this->db->where('tb_pengeringan.grade', $g['id_grade']);
                                          $tona = $this->db->get()->row()->total_tonase;
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
            url: '<?php echo base_url(); ?>admin/getNotaJualKS',
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(data) {

                var html = JSON.parse(data);
                var kode = 'JKS_' + html;
                var nodaf = kode;
                $('#kode_jual').val(nodaf);
            }
        });
    });
    

</script>