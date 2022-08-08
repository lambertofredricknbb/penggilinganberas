<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pengeringan</li>
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
      <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Data Pengeringan</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?= base_url('admin/print_pengeringan') ?>" class="btn btn-success"><i class="fas fa fa-print"></i> Cetak</a>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No Nota</th>
                        <th>Supplier</th>
                        <th>Urian</th>
                        <th>Belum Kering</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pengeringan_done as $p): ?>
                        <?php 
                          $this->db->select('SUM(tonase) as total_tonase');
                          $this->db->from('tb_pengeringan');
                          $this->db->where('tb_pengeringan.kode_pembelian', $p['kode_pembelian']);
                          $tonase = $this->db->get()->row()->total_tonase;

                          $this->db->select('SUM(tonase) as total_tonase');
                          $this->db->from('tb_pembelian');
                          $this->db->where('tb_pembelian.kode_pembelian', $p['kode_pembelian']);
                          $berat_awal = $this->db->get()->row()->total_tonase;

                          $akhir = $berat_awal - $tonase;
                          $persen = (($berat_awal - $akhir) / $berat_awal) * 100;
                        ?>
                      <tr class="text-center">
                          <th><b style="color: #f1c40f;"><?= $p['kode_pembelian'] ?></b></th>
                          <td><?= $p['nama_supplier'] ?></td>
                          <td><b><?= $p['musim'] ?></b> <?= $p['nama_jenis'] ?></td>
                          <?php foreach ($grade as $g): ?>
                            <?php
                            $this->db->select('*');
                            $this->db->from('tb_pengeringan');
                            $this->db->where('tb_pengeringan.grade', $g['id_grade']);
                            $this->db->where('tb_pengeringan.kode_pembelian', $p['kode_pembelian']);
                            $res = $this->db->get()->result_array();
                            ?>
                          <?php endforeach; ?>
                          <td><b><?= $tonase ?> Kg</b></td>
                          <!-- <td><?= ceil($persen) ?>%</td> -->
                          <!-- <td>
                              <?php if ($p['status'] == 'Belum Selesai'): ?>
                                  <span class="badge badge-pill badge-warning">Belum Kering</span>
                              <?php endif ?>
                              <?php if ($p['status'] == 'Selesai'): ?>
                                  <span class="badge badge-pill badge-success">Kering Semua</span>
                              <?php endif ?>
                          </td> -->
                          <td>
                              <a href="<?= base_url('admin/detail_pengeringan/').$p['kode_pembelian'] ?>" class="btn btn-success"><i class="fas fa fa-search-plus"></i></a>
                          </td>
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>