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
                  <li class="breadcrumb-item active" aria-current="page">Penggilingan</li>
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
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Detail Penggilingan</h3>
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
                                <th>Tanggal Mulai</th>
                                <th>Uraian</th>
                                <?php foreach ($detail as $d): ?>
                                    <?php if ($d['status'] == 2): ?>
                                        <th>Rendemen</th>
                                        <th>Tanggal Selesai</th>
                                    <?php endif ?>
                                    <?php if ($d['status'] == 1): ?>
                                        <th>Status</th>
                                    <?php endif ?>
                                <?php endforeach ?>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($detail as $d): ?>
                                  <tr>
                                    <td class="text-center"><?= tgl_indo(date('Y-m-d', strtotime($d['tanggal']))) ?></td>
                                    <td class="text-center"><b><?= $d['nama_jenis'] ?></b> Grade (<?= $d['nama_grade'] ?>) = <?= $d['tonase'] ?> Kg</td>
                                    <?php if ($d['status'] == 2): ?>
                                        <?php 
                                        $beras = $d['hasil_beras'];
                                        $tonase = $d['tonase'];
                                        $total = ($beras / $tonase) * 100;
                                         ?>
                                    <td class="text-center"><?= ceil($total) ?> %</td>
                                    <td class="text-center"><?= tgl_indo(date('Y-m-d', strtotime($d['tanggal_selesai']))) ?></td>
                                    <?php endif ?>
                                    <?php if ($d['status'] == 1): ?>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-danger">Belum Selesai</span>
                                    </td>
                                    <?php endif ?>
                                  </tr>
                              <?php endforeach ?>
                              
                            </tbody>
                          </table>
                        </div>
                </div>
              </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Hasil Penggilingan</h3>
                    </div>
                    <div class="col text-right">
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/update_proses_giling') ?>" method="post">
                        <?php foreach ($detail as $d): ?>
                            <input type="hidden" name="musim" value="<?= $d['musim'] ?>">
                            <input type="hidden" name="jenis" value="<?= $d['jenis'] ?>">
                            <input type="hidden" name="grade" value="<?= $d['grade'] ?>">
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        
                                        <?php if ($d['status'] == 1): ?>
                                            <label for="">Hasil Beras *<span style="color: red;">(Kg)</span></label>
                                            <input type="text" name="hasil_beras" class="form-control" required="">
                                        <?php endif ?>
                                        <?php if ($d['status'] == 2): ?>
                                            <!--<input type="text" value="<?= $d['hasil_beras'] ?>" class="form-control" required="" readonly>-->
                                        <?php endif ?>
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <?php if ($d['status'] == 1): ?>
                                            <label for="">Hasil Menir *<span style="color: red;">(Kg)</span></label>
                                            <input type="text" name="hasil_menir" class="form-control" required="">
                                        <?php endif ?>
                                        <?php if ($d['status'] == 2): ?>
                                            <!--<input type="text" value="<?= $d['hasil_menir'] ?>" class="form-control" required="" readonly>-->
                                        <?php endif ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?php if ($d['status'] == 1): ?>
                                            <label for="">Hasil Katul *<span style="color: red;">(Sak)</span></label>
                                            <input type="text" name="hasil_katul" class="form-control" required="">
                                        <?php endif ?>
                                        <?php if ($d['status'] == 2): ?>
                                            <!--<input type="text" value="<?= $d['hasil_katul'] ?>" class="form-control" required="" readonly>-->
                                        <?php endif ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?php if ($d['status'] == 1): ?>
                                            <label for="">Tanggal :</label>
                                            <input type="date" name="tanggal" class="form-control" required="">
                                        <?php endif ?>
                                        <?php if ($d['status'] == 2): ?>
                                            <!--<input type="date" value="<?= date('Y-m-d', $d['tanggal'])?>" class="form-control" required="" readonly>-->
                                        <?php endif ?>
                                    </div>
                                    
                                </div>
                        </div>
                        <input type="hidden" name="tanggal_selesai" value="<?= date('Y-m-d H:i:s') ?>">
                        <input type="hidden" name="id_giling" class="form-control" value="<?= $d['id_giling'] ?>">
                        <?php if ($d['status'] == 1): ?>
                                    <input type="submit" value="Simpan" class="btn btn-primary">
                                    <!--<input type="submit" value="Selesai" class="btn btn-block btn-success">-->
                        <?php endif ?>
                        <?php endforeach ?>
                    </form>
                    <br><br>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Hasil Beras</th>
                          <th scope="col">Hasil Menir</th>
                          <th scope="col">Hasil Katul</th>
                          <th scope="col">Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach($detail_proses as $dp): ?>
                        <tr>
                          <th scope="row"><?= $i ?></th>
                          <td><?= $dp['hasil_beras'] ?></td>
                          <td><?= $dp['hasil_menir'] ?></td>
                          <td><?= $dp['hasil_katul'] ?></td>
                          <td><?= tgl_indo(date('Y-m-d', strtotime($dp['tanggal']))) ?></td>
                        </tr>
                        <?php $i++; endforeach; ?>
                      </tbody>
                    </table>
                    <form class="my-5" action="<?= base_url('admin/proses_update_giling') ?>" method="post">
                        <?php foreach ($detail as $d): ?>
                            <input type="hidden" name="musim" value="<?= $d['musim'] ?>">
                            <input type="hidden" name="jenis" value="<?= $d['jenis'] ?>">
                            <input type="hidden" name="grade" value="<?= $d['grade'] ?>">
                            <input type="hidden" name="id_giling" value="<?= $d['id_giling'] ?>">
                            <?php if ($d['status'] == 1): ?>
                            <input type="submit" value="Selesai" class="btn btn-block btn-success">
                            <?php endif ?>
                        <?php endforeach; ?>
                    </form>
                </div>
              </div>
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>