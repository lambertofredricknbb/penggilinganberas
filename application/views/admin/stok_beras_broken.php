<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Stok Beras Broken</li>
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
                      <h3 class="mb-0">Stok Beras Broken</h3>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Beli Kering Giling
                      </button>
                    </div>
                  </div>
                </div>
                <div class="container">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>No Nota</th>
                              <th>Nama Supplier</th>
                              <th>Plat / Nama Supir</th>
                              <th>Tonase</th>
                              <th>Total Harga</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php foreach($broken as $b){ ?>
                          <tr>
                              <td><?= $b->kode_nota ?></td>
                              <td><?= $b->nama_supplier ?></td>
                              <td><?= $b->plat_kendaraan ?> / <?= $b->nama_supir ?></td>
                              <td><?= $b->tonase ?></td>
                              <td>Rp. <?= number_format($b->total); ?></td>
                              <td>
                                  <a href="<?= base_url('admin/edit_broken/') . $b->id ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                  <a href="<?= base_url('admin/del_broken/') . $b->id ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                  <a href="<?= base_url('admin/detail_broken/') . $b->id ?>" class="btn btn-sm btn-info"><i class="fas fa-search"></i></a>
                              </td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                  <br>
                  
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Pembelian Kering Giling</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?= base_url('admin/add_beras_broken') ?>" method="post">
                            <div class="modal-body text-left">
                              <input type="hidden" required="" name="id_user" value="<?= $user['id_user'] ?>">
                              <div class="row justify-content-left">
                                <div class="col-md-12 text-left">
                                  <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="">Kode Nota Otomatis</label>
                                            <input type="text" required="" class="form-control" readonly name="kode_pembelian" id="kode_pembelian">
                                        </div>
                                      </div>
                                      
                                      <div class="col-md-6">
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
                                </div>
                               
                                <div class="row">
                                  <div class="col-md-4">
                                  <label for="">Jenis Gabah</label>
                                  <select name="jenis_gabah" required="" class="form-control" id="">
                                      <option value="">-- Pilih Jenis --</option>
                                      <?php $jenis = $this->db->get('jenis_beras')->result_array(); foreach ($jenis as $j): ?>
                                          <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>
                              
                              <div class="col-md-4">
                                  <label for="">Tonase <span style="color: red;">(kg)</span></label>
                                  <input type="text" required="" class="form-control tonase" id="tonase" name="tonase">
                              </div>
                              
                              <div class="col-md-4">
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
                    </div
                  
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
