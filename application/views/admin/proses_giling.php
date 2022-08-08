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
              <?php if($user['level'] == 1): ?>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-0"> 
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Tambah Ke Penggilingan</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <form action="<?= base_url('admin/add_giling') ?>" method="post">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Musim :</label>
                            <select required="" name="musim" class="form-control" id="musim">
                              <option value="">-- Pilih --</option>
                              <?php
                              $this->db->select('*');
                              $this->db->from('tb_stok_kg');
                              $this->db->join('jenis_beras', 'tb_stok_kg.jenis = jenis_beras.id_jenis');
                              $this->db->join('grade', 'tb_stok_kg.grade = grade.id_grade');
                              // $this->db->group_by('tb_stok_kg.jenis');
                              $this->db->where('tb_stok_kg.tonase > 0');
                              $this->db->group_by('tb_stok_kg.musim');
                              $musim = $this->db->get()->result_array();
                              ?>
                              <?php foreach ($musim as $j): ?>
                                <option value="<?= $j['musim'] ?>"><?= $j['musim'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>  
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Jenis Gabah :</label>
                            <select required="" name="jenis" class="form-control" id="jenis">
                              <option value="">-- Pilih --</option>
                              <?php
                              $this->db->select('*');
                              $this->db->from('tb_stok_kg');
                              $this->db->join('jenis_beras', 'tb_stok_kg.jenis = jenis_beras.id_jenis');
                              $this->db->join('grade', 'tb_stok_kg.grade = grade.id_grade');
                              $this->db->group_by('tb_stok_kg.jenis');
                              $this->db->where('tb_stok_kg.tonase > 0');
                              // $this->db->group_by('tb_stok_kg.grade');
                              $this->db->order_by('tb_stok_kg.tanggal', 'DESC');
                              $jenis = $this->db->get()->result_array();
                              ?>
                              <?php foreach ($jenis as $j): ?>
                                <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>  
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Grade :</label>
                            <select required="" name="grade" class="form-control" id="grade">
                              <option value="">-- Pilih --</option>
                              <?php
                              $this->db->select('*');
                              $this->db->from('tb_stok_kg');
                              $this->db->join('jenis_beras', 'tb_stok_kg.jenis = jenis_beras.id_jenis');
                              $this->db->join('grade', 'tb_stok_kg.grade = grade.id_grade');
                              // $this->db->group_by('tb_stok_kg.jenis');
                              $this->db->group_by('tb_stok_kg.grade');
                              $this->db->order_by('tb_stok_kg.tanggal', 'DESC');
                              $this->db->where('tb_stok_kg.tonase > 0');
                              $grade = $this->db->get()->result_array();
                              ?>
                              <?php foreach ($grade as $g): ?>
                                <option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>  
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Tonase :</label>
                            <input required="" type="text" class="form-control" id="tonase" name="tonase">
                          </div>
                        </div>
                      </div>
                      <!-- <h2>Penambahan Beras</h2>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Tonase Beras</label>
                            <input type="text" class="form-control" name="tonase_b">
                          </div>
                        </div>
                      </div> -->
                      <!-- <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Hasil <span style="color: red;">(Kg)</span></label>
                            <input type="text" required="" class="form-control" name="hasil">
                          </div>
                        </div>
                      </div> -->
                      <input type="hidden" name="tanggal" value="<?= date('Y-m-d H:i:s') ?>">
                      <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                      <input type="submit" class="btn btn-success btn-block" value="Giling">

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>
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
                      <h3 class="mb-0">Data Proses Penggilingan</h3>
                    </div>
                    <div class="col text-right">
                      <!-- <a href="<?= base_url('admin/jual_beras') ?>" class="btn btn-warning">Jual Beras</a> -->
                      <!-- <a href="#" data-toggle="modal" data-target="#stok_beras" class="btn btn-success">Stok Hasil Giling</a> -->
                      <div class="modal fade" id="stok_beras" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Stok Hasil Giling</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-left">
                              <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr class="text-center">
                                    <th><b>No.</b></th>
                                    <th><b>Beras</b></th>
                                    <th><b>Menir</b></th>
                                    <th><b>Katul</b></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1; foreach ($hasil as $h): ?>
                                     <tr class="text-center">
                                       <td><b><?= $i; ?></b></td>
                                       <td><?= $h['hasil_beras'] ?> Kg</td>
                                       <td><?= $h['hasil_menir'] ?> Kg</td>
                                       <td><?= $h['hasil_katul'] ?> Kg</td>
                                     </tr>                       
                                  <?php $i++; endforeach ?>                        
                                </tbody>
                              </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <?php foreach ($hasil as $h): ?>
                      <div class="row">
                        <div class="col-md-4">
                          <h2>Stok Beras : <span style="font-weight: 800; color: #0097e6;"><?= $h['hasil_beras'] ?> Kg</span></h2>
                        </div>
                        <div class="col-md-4">
                          <h2>Stok Menir : <span style="font-weight: 800; color: #0097e6;"><?= $h['hasil_menir'] ?> Kg</span></h2>
                        </div>
                        <div class="col-md-4">
                          <h2>Stok Katul : <span style="font-weight: 800; color: #0097e6;"><?= $h['hasil_katul'] ?> Kg</span></h2>
                        </div>
                      </div>
                    <?php endforeach ?><br>
                    <a href="<?= base_url('admin/print_excel_giling') ?>" class="btn btn-success ml-auto"><i class="fas fa fa-print"></i> Print Laporan</a><br><br>
                    <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b>No.</b></th>
                                <th><b>Beras</b></th>
                                <th><b>Tonase</b></th>
                                <th><b>Hasil Beras</b></th>
                                <th><b>Tanggal</b></th>
                                <th><b>Status</b></th>
                                <?php if($user['level'] == 1): ?>
                                <th><b>Aksi</b></th>
                                <?php endif ?>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($giling as $g): ?>
                                  <tr>
                                    <th class="text-center"><?= ++$start ?></th>
                                    <td><b><?= $g['musim'] ?></b> => <?= $g['nama_jenis'] ?> ( <?= $g['nama_grade'] ?> )
                                    </td>
                                    <td  class="text-center"><?= $g['tonase'] ?> Kg</td>
                                    <td>
                                      <?php if ($g['hasil_beras'] == 0): ?>
                                        <span class="badge badge-danger badge-pill">Belum Digiling</span>
                                      <?php endif ?>
                                      <?php if ($g['hasil_beras'] != 0): ?>
                                        <b>Beras :</b> <?= $g['hasil_beras'] ?> Kg
                                      <?php endif ?>
                                    </td>
                                    <td class="text-center">
                                      <?= tgl_indo(date('Y-m-d', strtotime($g['tanggal']))) ?>
                                    </td>
                                    <td class="text-center">
                                    <?php if ($g['status'] == 1): ?>
                                        <span class="badge badge-pill badge-danger">Belum Selesai</span>
                                    <?php endif ?>
                                    <?php if ($g['status'] == 2): ?>
                                        <span class="badge badge-pill badge-success">Selesai</span>
                                    <?php endif ?>
                                    </td>
                                    <?php if($user['level'] == 1): ?>
                                    <td class="text-center">
                                      <a href="<?= base_url('admin/detail_giling/').$g['id_giling'] ?>" class="btn btn-success"><i class="fas fa fa-search"></i></a>
                                      <!-- <a href="" class="btn btn-danger"><i class="fas fa fa-trash"></i></a> -->
                                    </td>
                                    <?php endif ?>
                                  </tr>                       
                                <?php endforeach ?>                           
                            </tbody>
                          </table>
                        </div>
                        <div class="row justify-content-right">
                            <div class="col-md-11">
                              <?= $this->pagination->create_links(); ?>
                            </div>
                        </div>
                </div>
                
              </div>
        </div>
      </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  // $(document).ready(function(){
  //      $(document).on("change", "#grade", function () {
  //         var grade = $(this).val();
  //         var jenis = $('#jenis').val();
  //         var musim = $('#musim').val();
  //         $.ajax({
  //             type : "POST",
  //             url  : "<?php echo base_url('admin/get_tonase')?>",
  //             dataType : "JSON",
  //             data : {grade: grade},
  //             cache:false,
  //             success: function(data){
  //                 $.each(data,function(tonase){
  //                     $('#tonase').val(data.tonase);
  //                 });
  //             }
  //         });
  //         return false;
  //    });
  // });
</script>