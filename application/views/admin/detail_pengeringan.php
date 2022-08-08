<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Admin</li>
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span><b>No Nota</b></span><br>
                                <span><b>Nama Supplier</b></span><br>
                                <span><b>Kendaraan</b></span><br>
                            </div>
                            <div class="col-md-6">
                                <span style="font-weight:  700; color: #f1c40f; ">: <?= $d['kode_pembelian'] ?></span><br>
                                <span>: <?= $d['nama_supplier'] ?></span><br>
                                <span>: <?= $d['nama_supir'] ?> / <?= $d['plat'] ?></span><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <br>
                                <span><b>Status</b></span><br>
                                <span><b>Musim</b></span><br>
                            </div>
                            <div class="col-md-8">
                                <br>
                                :  <?php if ($d['status'] == 'Belum Selesai'): ?>
                                  <span class="badge badge-pill badge-warning">Belum Selesai</span>
                                  <?php endif ?>
                                  <?php if ($d['status'] == 'Selesai'): ?>
                                      <span class="badge badge-pill badge-success">Selesai</span>
                                  <?php endif ?>
                                <br>
                                : <span><?= $d['musim'] ?></span><br>
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
                              <th scope="col">Uraian</th>
                              <th scope="col">Keterangan</th>
                              <!-- <th scope="col">Penyusutan</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <!-- format tanggal -->

                             <!-- tabel -->
                            <?php 
                            $this->db->select('*');
                            $this->db->from('tb_pengeringan');
                            $this->db->join('jenis_beras', 'tb_pengeringan.jenis_gabah = jenis_beras.id_jenis');
                            $this->db->join('grade', 'tb_pengeringan.grade = grade.id_grade');
                            $this->db->where('tb_pengeringan.kode_pembelian', $d['kode_pembelian']);
                            // $this->db->where('tb_pengeringan.tonase != 0');
                            // $this->db->where('tb_pengeringan.penyusutan != 0');
                            // $this->db->where('tb_pengeringan.teknik != 0');
                            $result = $this->db->get();
                             ?>
                            <?php $i=1; foreach ($result->result_array() as $p): ?>
                                <?php
                                $this->db->select('SUM(penyusutan) as susut');
                                $this->db->from('tb_pengeringan');
                                $this->db->where('tb_pengeringan.kode_pembelian', $p['kode_pembelian']);
                                $this->db->where('tb_pengeringan.jenis_gabah', $p['jenis_gabah']);
                                $this->db->where('tb_pengeringan.grade', $p['grade']);
                                $this->db->where('tb_pengeringan.musim', $p['musim']);
                                $this->db->where('tb_pengeringan.penyusutan != 0');
                                $susut = $this->db->get()->row()->susut;

                                $this->db->select('SUM(tonase) as awal');
                                $this->db->from('tb_pembelian');
                                $this->db->where('tb_pembelian.kode_pembelian', $p['kode_pembelian']);
                                $this->db->where('tb_pembelian.jenis_gabah', $p['jenis_gabah']);
                                $this->db->where('tb_pembelian.grade', $p['grade']);
                                $this->db->where('tb_pembelian.musim', $p['musim']);
                                // $this->db->where('tb_pembelian.tonase != 0');
                                $awal = $this->db->get()->row()->awal;
                                $persen = ($awal - $susut);  
                                 ?>
                                <tr class="text-center">
                                  <th class="text-center" scope="row"><?= $i ?></th>
                                  <td><?= $p['nama_jenis'] ?> (GRADE <?= $p['nama_grade'] ?>) 
                                    <?php if ($p['teknik'] != 0): ?>
                                      <?php if ($p['teknik'] == 1){
                                        echo ": <b>Teknik Jemur</b>";
                                      }else{
                                        echo ": <b>Teknik Dryer</b>";
                                      } ?>
                                    <?php endif ?></td>
                                  <?php if ($p['status'] == 'Belum Selesai'): ?>
                                      <td>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <b>Tonase : <?= $p['tonase'] ?> Kg</b>
                                              </div>
                                              <div class="col-md-6 text-right">
                                                  
                                                  <span class="badge badge-pill badge-danger">Belum Selesai</span>
                                              </div>
                                          </div>
                                        
                                      </td>
                                  <?php endif ?>
                                  <?php if ($p['status'] == 'Selesai'): ?>
                                      <td>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <b>Status</b> : <span class="badge badge-pill badge-success">Selesai</span>
                                              </div>
                                              <div class="col-md-6 text-right">
                                                  <b>Susut</b> : <?= ceil(($persen / $awal) * 100) ?>%
                                              </div>
                                          </div>
                                      </td>
                                  <?php endif ?>
                                  <!-- <td><?= $persen ?>%</td> -->
                                </tr>
                            <?php $i++; endforeach ?>
                          </tbody>
                        </table>
                    </div>
                </div><hr>
                <?php
                    $this->db->select('SUM(tonase) as total_tonase');
                    $this->db->from('tb_pengeringan');
                    $this->db->where('tb_pengeringan.kode_pembelian', $d['kode_pembelian']);
                    $tonase = $this->db->get()->row()->total_tonase;
                ?>
                <div class="row justify-content-center">
                    <?php if ($tonase != 0): ?>
                    <div class="col-md-10 text-center">
                        <span class="badge badge-primary" style="font-size: 15pt; width: 80%;">Proses Pengeringan</span><br><br>
                    </div>
                    <?php endif ?>
                    <?php if ($tonase == 0): ?>
                    <div class="col-md-10 text-center">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Pengeringan Selesai!</strong> Silahkan Cek di Stock Kering Giling.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php
                        $this->db->select('SUM(tonase) as total_tonase');
                        $this->db->from('tb_pengeringan');
                        $this->db->where('tb_pengeringan.kode_pembelian', $d['kode_pembelian']);
                        $tonase = $this->db->get()->row()->total_tonase;
                    ?>
                    <div class="col-md-12">
                        <?php if ($tonase != 0): ?>
                            <form action="<?= base_url('admin/add_proses_pengeringan') ?>" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php
                                        $this->db->select('*');
                                        $this->db->from('tb_pengeringan');
                                        $this->db->join('jenis_beras', 'tb_pengeringan.jenis_gabah = jenis_beras.id_jenis');
                                        $this->db->join('grade', 'tb_pengeringan.grade = grade.id_grade');
                                        $this->db->where('tb_pengeringan.kode_pembelian', $d['kode_pembelian']);
                                        $this->db->where('tb_pengeringan.tonase != 0');
                                        // $this->db->group_by('tb_pengeringan.id_pengeringan');
                                        $beras = $this->db->get()->result_array();
                                        ?>
                                        <label for="">Pilih Grade :</label>
                                        <select <?php if($d['status'] == 'Selesai'){ echo "readonly"; } ?> name="beras" class="form-control" id="beras">
                                            <option value="">-- Pilih Grade --</option>
                                            <?php foreach ($beras as $b): ?>
                                                <option value="<?= $b['id_pengeringan'] ?>-<?= $b['tonase'] ?>-<?= $b['jenis_gabah'] ?>-<?= $b['grade'] ?>-<?= $b['musim'] ?>"><?= $b['nama_jenis'] ?> ( Grade <?= $b['nama_grade'] ?> )</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="id_pengeringan" id="id_pengeringan">
                                        <input type="hidden" name="jenis" id="jenis">
                                        <input type="hidden" name="musim" id="musim">
                                        <input type="hidden" name="grade" id="grade">
                                        <!--<input type="hidden" id="tonase">-->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Teknik Pengeringan :</label>
                                    <select <?php if($d['status'] == 'Selesai'){ echo "readonly"; } ?> name="teknik" class="form-control" id="">
                                        <option value="1">Teknik Jemur</option>
                                        <option value="2">Teknik Drying</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Hasil Penyusutan : <span style="color: red;">(Kg)</span></label>
                                    <input type="text" <?php if($d['status'] == 'Selesai'){ echo "readonly"; } ?> class="form-control" name="penyusutan">
                                </div>
                            </div>
                            <div class="row">

                                <?php
                                $this->db->select('SUM(tonase) as total_tonase');
                                $this->db->from('tb_pengeringan');
                                $this->db->where('tb_pengeringan.kode_pembelian', $d['kode_pembelian']);
                                $tonase = $this->db->get()->row()->total_tonase;
                                ?>
                                <!-- <div class="col-md-6"> -->
                                    <!-- <label for="">Berat :</label> -->
                                    <input type="hidden" name="berat" min="0" max="<?= $tonase ?>" id="beratnya" class="form-control" id="berat">
                                <!-- </div> -->
                                
                            </div><br>
                            <input type="hidden" name="tonase" id="hasil">
                            <input type="hidden" value="<?= $d['kode_pembelian'] ?>" name="kode_pembelian">
                            <?php if($d['status'] == 'Belum Selesai'){ ?>
                            <input type="submit" class="btn btn-primary btn-block" value="Simpan">
                            <?php } ?>

                        </form>
                        <br>
                        <table class="table table-hover mt-3">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Musim</th>
                              <th scope="col">Jenis</th>
                              <th scope="col">Grade</th>
                              <th scope="col">Hasil</th>
                              <th scope="col">Tanggal</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; foreach($proses_pengeringan as $p): ?>
                            <tr>
                              <th scope="row"><?= $i ?></th>
                              <td><?= $p['musim'] ?></td>
                              <td><?= $p['nama_jenis'] ?></td>
                              <td><?= $p['nama_grade'] ?></td>
                              <td><?= $p['hasil'] ?> Kg</td>
                              <td><?= tgl_indo(date('Y-m-d', strtotime($p['tanggal']))) ?></td>
                            </tr>
                            <?php $i++; endforeach; ?>
                          </tbody>
                        </table>
                        <br>
                        <?php if($d['status'] == 'Belum Selesai'){ ?>
                        <form action="<?= base_url('admin/selesai_proses_pengeringan') ?>" method="post">
                            <input type="hidden" value="<?= $d['kode_pembelian'] ?>" name="kode_pembelian">
                            <input type="submit" class="btn btn-success btn-block" value="Selesai">
                        </form>
                        <?php } ?>

                        <?php endif ?>
                        <?php
                        $this->db->select('SUM(tonase) as total_tonase');
                        $this->db->from('tb_pengeringan');
                        $this->db->where('tb_pengeringan.kode_pembelian', $d['kode_pembelian']);
                        $tonase = $this->db->get()->row()->total_tonase;
                        ?>
                        <?php if ($tonase != 0): ?>
                            <?php 
                                $this->db->select('*');
                                $this->db->from('tb_pembelian');
                                $this->db->join('jenis_beras', 'tb_pembelian.jenis_gabah = jenis_beras.id_jenis');
                                $this->db->join('grade', 'tb_pembelian.grade = grade.id_grade');
                                $this->db->where('tb_pembelian.kode_pembelian', $d['kode_pembelian']);
                                $result = $this->db->get()->result_array();
                             ?>
                                    <form action="<?= base_url('admin/proses_add_stock') ?>" method="post">
                                        <input type="hidden" name="musim" value="<?= $d['musim'] ?>">
                                        <input type="hidden" name="kode_pembelian" value="<?= $d['kode_pembelian'] ?>"><br>
                                        <?php foreach ($result as $r): ?>
                                            <input type="hidden" name="jenis[]" value="<?= $r['jenis_gabah'] ?>">
                                            <input type="hidden" name="grade[]" value="<?= $r['grade'] ?>">
                                            <input type="hidden" name="tonase[]" value="<?= $r['tonase'] ?>">
                                            <br>
                                        <?php endforeach ?>
                                        <input type="hidden" name="tanggal" value="<?=date('Y-m-d') ?>">
                                        <?php if ($d['status'] == 'Belum Selesai'): ?>
                                        <div class="row justify-content-center">
                                            <!--<div class="col-md-12 text-center">-->
                                            <!--    <button type="submit" class="btn btn-success"><i class="fas fa fa-check"></i> Selesai</button><br>-->
                                            <!--    <span style="color: red; font-style: italic;">Silahkan Klik Selesai Jika Gabah Sudah Kering Semua</span>-->
                                            <!--</div>-->
                                        </div>
                                    <?php endif ?>
                                    </form>
                        <?php endif ?>


                    </div>
                </div>
                <?php endforeach ?>

            </div>
        </div>
        </div>
      </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).on("change", "#beras", function () {
                var select = $(this).val();
                var data = select.split('-');
                var id = data[0]
                var tonase = data[1]
                var jenis = data[2]
                var grade = data[3]
                var musim = data[4]
                var total = 0
                $('#hasil').val(total);
                $('#id_pengeringan').val(id),
                $('#beratnya').val(tonase)
                $('#jenis').val(jenis)
                $('#grade').val(grade)
                $('#musim').val(musim)

            });
    // $('#berat').keyup(function(){
    //     var tonase = $('#tonase').val();
    //     var berat = $(this).val();
    //     var total = Number(tonase) - Number(berat);
    //     $('#hasil').val(total);
    // });
    

</script>