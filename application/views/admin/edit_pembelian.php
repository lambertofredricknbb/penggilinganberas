<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Pembelian</li>
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
                      <h3 class="mb-0">Edit Pembelian</h3>
                  </div>
                </div>
                <?php if($this->session->flashdata('err_msg')){ ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('err_msg'); ?></div>
                <?php } ?>
                <!--<form action="" method="post">-->
                <!--<div class="row">-->
                <!--    <div class="col-md-3">-->
                <!--        <div class="form-group">-->
                <!--            <label>Kode Nota</label>-->
                <!--            <input type="text" class="form-control" name="nota" value="<?= $pelanggan->kode_pembelian ?>" disabled>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-md-3">-->
                <!--        <div class="form-group">-->
                <!--            <label>Nama Supplier</label>-->
                <!--            <input type="text" required class="form-control" name="supplier" value="<?= $pelanggan->nama_supplier ?>">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-md-3">-->
                <!--        <div class="form-group">-->
                <!--            <label>Nama Supir</label>-->
                <!--            <input type="text" required class="form-control" name="supir" value="<?= $pelanggan->nama_supir ?>">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-md-3">-->
                <!--        <div class="form-group">-->
                <!--            <label>Plat Kendaraan</label>-->
                <!--            <input type="text" required class="form-control" name="plat" value="<?= $pelanggan->plat ?>">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-md-6">-->
                <!--        <div class="form-group">-->
                <!--            <label>Nama Musim</label>-->
                <!--            <select name="musim" required class="form-control">-->
                <!--                <option value="">--Pilih Musim--</option>-->
                <!--                <option value="rojoan">Rojoan</option>-->
                <!--                <option value="gaduan">Gaduan</option>-->
                <!--            </select>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-md-6">-->
                <!--        <div class="form-group">-->
                <!--            <label>Jenis Gabah</label>-->
                <!--            <select name="jenis" required class="form-control">-->
                <!--                <option value="">--Pilih Jenis--</option>-->
                <!--                <?php foreach($jenis as $j){ ?>-->
                <!--                <?php if($j->id_jenis == $pelanggan->jenis_gabah){ ?>-->
                <!--                    <option value="<?= $j->id_jenis; ?>" selected><?= $j->nama_jenis; ?></option>-->
                <!--                <?php } else { ?>-->
                <!--                    <option value="<?= $j->id_jenis; ?>"><?= $j->nama_jenis; ?></option>-->
                <!--                <?php } ?>-->
                <!--                <?php } ?>-->
                <!--            </select>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <?php foreach($pesanan as $p){ ?>-->
                <!--    <div class="row justify-content-center">-->
                <!--        <div class="col-md-3">-->
                <!--            <div class="form-group">-->
                <!--                <label>Grade</label>-->
                <!--                <?php $grade = $this->db->get_where('grade',['id_grade' => $p->grade])->row(); ?>-->
                <!--                <input type="text" class="form-control" disabled name="grade[]" value="<?= $grade->nama_grade ?>">-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="col-md-3">-->
                <!--            <div class="form-group">-->
                <!--                <label>KA(%)</label>-->
                <!--                <input type="text" class="form-control" name="ka[]" value="<?= $p->ka ?>">-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="col-md-3">-->
                <!--            <div class="form-group">-->
                <!--                <label>Tonase (Kg)</label>-->
                <!--                <input type="text" class="form-control" name="tonase[]" value="<?= $p->tonase ?>">-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="col-md-3">-->
                <!--            <div class="form-group">-->
                <!--                <label>Harga / Kg</label>-->
                <!--                <input type="text" class="form-control" name="harga[]" value="<?= $p->harga_kg ?>">-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <input type="hidden" required="" value="0" class="total" name="total[]" id="total<?= $x ?>">-->
                <!--    </div>-->
                <!--    <?php } ?>-->
                    
                <!--</div>-->
                <!--    <div class="form-group">-->
                <!--        <label>Keterangan</label>-->
                <!--        <textarea class="form-control" name="keterangan"><?= $pelanggan->keterangan; ?></textarea>-->
                <!--    </div>-->
                <!--    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>-->
                <!--</form>-->
                
                
                <form action="" method="post">
                    <input type="hidden" required="" name="id_user" value="<?= $user['id_user'] ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="">Kode Nota</label>
                                <input type="text" required="" class="form-control" value="<?= $pelanggan->kode_pembelian ?>" readonly name="kode_pembelian" id="kode_pembelian">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="">Nama Supplier</label>
                                <input type="text" required="" class="form-control" value="<?= $pelanggan->nama_supplier ?>" name="nama_supplier">
                            </div>
                         </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nama Supir</label>
                                <input type="text" required="" name="nama_supir" value="<?= $pelanggan->nama_supir ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Plat Kendaraan</label>
                                <input type="text" required="" name="plat" id="plat" value="<?= $pelanggan->plat ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Musim</label>
                                <select name="musim" required class="form-control" id="">
                                    <option value="">-- Pilih Musim --</option>
                                    <option value="rojoan">Rojoan</option>
                                    <option value="gaduan">Gaduan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Jenis Gabah</label>
                                <select name="jenis_gabah" required="" class="form-control" id="">
                                    <option value="">-- Pilih Jenis --</option>
                                        <?php foreach ($jenis as $j): ?>
                                            <?php if($j->id_jenis == $pelanggan->jenis_gabah){?>
                                                <option value="<?= $j->id_jenis ?>" selected><?= $j->nama_jenis ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $j->id_jenis ?>"><?= $j->nama_jenis ?></option>
                                            <?php } ?>
                                        <?php endforeach ?>
                                    </select>
                            </div>
                        </div>
                    </div>
                    
                    <?php $x=1; foreach ($G_grade as $g): ?>
                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Grade</label>
                                            <input type="text" readonly="" value="<?= $g['nama_grade'] ?>" class="form-control">
                                            <input type="hidden" readonly="" value="<?= $g['id_grade'] ?>" name="grade[]" class="form-control">
                                            
                                        </div>
                    <?php $pemb = $this->db->get_where('tb_pembelian',['kode_pembelian' => $pelanggan->kode_pembelian, 'grade' => $g['id_grade']])->row(); ?>
                    
                                        <div class="col-md-3">
                                            <label for="">KA <span>%</span></label>
                                            <input type="text" class="form-control" name="ka[]" value="<?= $pemb->ka; ?>">
                                            <input type="hidden" name="id[]" value="<?= $pemb->id_pembelian ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Tonase <span style="color: red;">(kg)</span></label>
                                            <input type="text" value="<?= $pemb->tonase ?>" class="form-control tonase" id="tonase<?= $x ?>" name="tonase[]">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Harga /kg</label>
                                            <input type="text" class="form-control" value="<?= $pemb->harga_kg ?>" id="harga_kg<?= $x ?>" name="harga_kg[]">
                                        </div>
                                        <input type="hidden" required="" value="0" class="total" name="total[]" id="total<?= $x ?>">
                                    </div>
                                    <?php 
                                    $jum = $this->db->get('grade')->num_rows();
                                     ?>
                                     <input type="hidden" id="jum" value="<?= $jum ?>">
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                    <script type="text/javascript">
                                    $(document).ready(function() {
                                        var jum = $('#jum').val();
                                        $('#tonase' + <?= $x ?>).keyup(function(){
                                            var tonase = $('#tonase' + <?= $x ?>).val();
                                            var harga_kg = $('#harga_kg' + <?= $x ?>).val();
                                            var total = Number(tonase) * Number(harga_kg)
                                            $('#total' + <?= $x ?>).val(total);
                                        });
                                        $('#harga_kg' + <?= $x ?>).keyup(function(){
                                            var tonase = $('#tonase' + <?= $x ?>).val();
                                            var harga_kg = $('#harga_kg' + <?= $x ?>).val();
                                            var total = Number(tonase) * Number(harga_kg)
                                            $('#total' + <?= $x ?>).val(total);
                                        });
                                    });
                                    </script>
                                    
                    <?php $x++; endforeach ?>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" class="form-control"><?= $pelanggan->keterangan ?></textarea>
                            </div>
                        </div><hr>
                    </div>
                    <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
                    
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    
                </form>
                
                
              </div>
        </div>
      <!-- </div> -->