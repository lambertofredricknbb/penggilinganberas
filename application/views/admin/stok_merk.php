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
                      <h3 class="mb-0">Stock Merk Beras</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="#" data-toggle="modal" data-target="#jual" class="btn btn-success"><i class="fas fa fa-dollar-sign"></i> Jual Beras</a>
                        <!-- Modal -->
                        <div class="modal fade" id="jual" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="<?= base_url('admin/jual_beras_kebi') ?>" method="post">
                              <div class="modal-body text-left">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Merk :</label>
                                    <select class="form-control" name="merk" required>
                                        <option value="">-- pilih --</option>
                                        <?php foreach($this->db->get('merk_beras')->result_array() as $m): ?>
                                            <option value="<?= $m['id_merk'] ?>"><?= $m['nama_merk'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Ukuran :</label>
                                    <select class="form-control" required name="ukuran">
                                        <option value="">-- pilih --</option>
                                        <option value="5kg">5kg</option>
                                        <option value="10kg">10kg</option>
                                        <option value="25kg">25kg</option>
                                        <option value="50kg">50kg</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Jumlah :</label>
                                    <input type="text" name="jumlah" required class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Total Harga :</label>
                                    <input type="text" name="total_harga" required class="form-control">
                                  </div>
                              </div>
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
                <!--endmodal-->
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">

                        <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b style="font-weight: 900;">Merk</b></th>
                                <th><b>5 Kg</b></th>
                                <th><b>10 Kg</b></th>
                                <th><b>25 Kg</b></th>
                                <th><b>50 Kg</b></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->db->get('merk_beras')->result_array() as $m): ?>
                                    <tr class="text-center">
                                        <td><b><?= $m['nama_merk'] ?></b></td>
                                        <?php
                                          $this->db->select('SUM(5kg) as total');
                                          $this->db->from('tb_beras_kebi');
                                          $this->db->where('tb_beras_kebi.merk', $m['id_merk']);
                                          $limakg = $this->db->get()->row()->total;
                                        ?>

                                        <?php if ($limakg != 0): ?>
                                            <td><?= $limakg ?> Sak</td>
                                        <?php endif ?>
                                        <?php if ($limakg == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>

                                        <!-- 10 -->
                                        <?php
                                          $this->db->select('SUM(10kg) as totall');
                                          $this->db->from('tb_beras_kebi');
                                          $this->db->where('tb_beras_kebi.merk', $m['id_merk']);
                                          $sepuluhkg = $this->db->get()->row()->totall;
                                        ?>

                                        <?php if ($sepuluhkg != 0): ?>
                                            <td><?= $sepuluhkg ?> Sak</td>
                                        <?php endif ?>
                                        <?php if ($sepuluhkg == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <!-- 25 -->
                                        <?php
                                          $this->db->select('SUM(25kg) as total');
                                          $this->db->from('tb_beras_kebi');
                                          $this->db->where('tb_beras_kebi.merk', $m['id_merk']);
                                          $dualimakg = $this->db->get()->row()->total;
                                        ?>

                                        <?php if ($dualimakg != 0): ?>
                                            <td><?= $dualimakg ?> Sak</td>
                                        <?php endif ?>
                                        <?php if ($dualimakg == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        <!-- 50 -->
                                        <?php
                                          $this->db->select('SUM(50kg) as total');
                                          $this->db->from('tb_beras_kebi');
                                          $this->db->where('tb_beras_kebi.merk', $m['id_merk']);
                                          $limapuluhkg = $this->db->get()->row()->total;
                                        ?>

                                        <?php if ($limapuluhkg != 0): ?>
                                            <td><?= $limapuluhkg ?> Sak</td>
                                        <?php endif ?>
                                        <?php if ($limapuluhkg == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>  
                                <tr class="text-center" style="background-color: #ecf0f1;">
                                        <td>Total : </td>
                                        <?php
                                          $this->db->select('SUM(5kg) as total');
                                          $this->db->from('tb_beras_kebi');
                                          $limakg = $this->db->get()->row()->total;
                                        ?>

                                        <?php if ($limakg != 0): ?>
                                            <td><?= $limakg ?> Sak</td>
                                        <?php endif ?>
                                        <?php if ($limakg == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        
                                        <?php
                                          $this->db->select('SUM(10kg) as total');
                                          $this->db->from('tb_beras_kebi');
                                          $sepuluhkg = $this->db->get()->row()->total;
                                        ?>

                                        <?php if ($sepuluhkg != 0): ?>
                                            <td><?= $sepuluhkg ?> Sak</td>
                                        <?php endif ?>
                                        <?php if ($sepuluhkg == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        
                                        <?php
                                          $this->db->select('SUM(25kg) as total');
                                          $this->db->from('tb_beras_kebi');
                                          $dualimakg = $this->db->get()->row()->total;
                                        ?>

                                        <?php if ($dualimakg != 0): ?>
                                            <td><?= $dualimakg ?> Sak</td>
                                        <?php endif ?>
                                        <?php if ($dualimakg == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                        
                                        <?php
                                          $this->db->select('SUM(50kg) as total');
                                          $this->db->from('tb_beras_kebi');
                                          $limapuluhkg = $this->db->get()->row()->total;
                                        ?>

                                        <?php if ($limapuluhkg != 0): ?>
                                            <td><?= $limapuluhkg ?> Sak</td>
                                        <?php endif ?>
                                        <?php if ($limapuluhkg == 0): ?>
                                            <td>-</td>
                                        <?php endif ?>
                                    </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    
                </div>
                
              </div>
              <br>
              <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col-md-6">
                      <h3 class="mb-0">Jual Beras</h3>
                    </div>
                    <div class="col-md-6 text-right">
                    </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">

                        <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr class="text-center">
                                <th><b style="font-weight: 900;">No</b></th>
                                <th><b>Merk</b></th>
                                <th><b>Ukuran</b></th>
                                <th><b>Jumlah</b></th>
                                <th><b>Total Harga</b></th>
                                <th><b>Tanggal</b></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($jual_beras_kebi as $j): ?>
                                    <tr class="text-center">
                                        <th><?= $i ?></th>
                                        <td><?= $j['nama_merk'] ?></td>
                                        <td><?= $j['ukuran'] ?>Kg</td>
                                        <td><?= $j['jumlah'] ?></td>
                                        <td>Rp. <?= number_format($j['total_harga'], 0, '.','.') ?></td>
                                        <td><?= tgl_indo(date('Y-m-d', strtotime($j['tanggal']))) ?></td>
                                    </tr>
                                <?php $i++; endforeach; ?>
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