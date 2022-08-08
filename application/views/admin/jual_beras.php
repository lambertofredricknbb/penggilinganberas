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
                  <li class="breadcrumb-item active" aria-current="page">Penjualan Beras Giling</li>
                </ol>
              </nav>
            </div>
          </div>
          <!-- Card stats -->
          <div class="row justify-content-center">
            
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-0"> 
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Penjualan Beras Giling</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <form action="<?= base_url('admin/add_jual_beras') ?>" method="post">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Kode Penjualan :</label>
                            <input type="text" required="" id="kode_penjualan" readonly="" class="form-control" name="kode_penjualan">
                          </div>  
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Tonase Beras :</label>
                            <input required="" type="text" class="form-control" name="tonase_beras">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Pembeli :</label>
                            <input type="text" name="nama_pembeli" class="form-control">
                          </div>
                        </div>
                        <input type="hidden" name="tanggal" value="<?= date('Y-m-d H:i:s') ?>">
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
                      <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                      <input type="submit" class="btn btn-success btn-block" value="Simpan">

                    </form>
                  </div>
                </div>
              </div>
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
                      <h3 class="mb-0">Data Penjualan Beras Hasil Giling</h3>
                    </div>
                    <div class="col text-right">
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b>No.</b></th>
                                <th><b>Kode Penjualan</b></th>
                                <th><b>User</b></th>
                                <th><b>Nama Pembeli</b></th>
                                <th><b>Tonase Beras</b></th>
                                <th><b>Tanggal</b></th>
                                <th><b>Aksi</b></th>
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
                                      <a href="" class="btn btn-danger"><i class="fas fa fa-trash"></i></a>
                                    </td>
                                  </tr>                       
                                <?php $i++; endforeach ?>                           
                            </tbody>
                          </table>
                        </div>
                </div>
                
              </div>
        </div>
      </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
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
</script>