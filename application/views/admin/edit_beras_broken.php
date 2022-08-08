<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                    </div>
                    <div class="col text-right">
                    </div>
                  </div>
                </div>
                <div class="container">
                      <form action="<?= base_url('admin/edit_beras_broken') ?>" method="post">
                          <input type="hidden" name="id" value="<?= $broken->id ?>">
                  <div class="row">
                      <div class="col-lg-6">
                          <div class="form-group">
                                <label class="form-control-label" for="">Kode Nota</label>
                                <input type="text" required="" value="<?= $broken->kode_nota ?>" class="form-control" readonly name="kode_pembelian" id="kode_pembelian">
                            </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group">
                                <label class="form-control-label" for="">Nama Supplier</label>
                                <input type="text" required="" value="<?= $broken->nama_supplier ?>" class="form-control" name="nama_supplier">
                            </div>
                      </div>
                      
                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Supir</label>
                                    <input type="text" required="" value="<?= $broken->nama_supir ?>" name="nama_supir" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Plat Kendaraan</label>
                                    <input type="text" required="" value="<?= $broken->plat_kendaraan ?>" name="plat" id="plat" class="form-control">
                                </div>
                            </div>
                    
                   
                    
                        <div class="col-md-4">
                            <label for="">Jenis Gabah</label>
                            <select name="jenis_gabah" required="" class="form-control" id="">
                                <option value="">-- Pilih Jenis --</option>
                                <?php $jenis = $this->db->get('jenis_beras')->result_array(); foreach ($jenis as $j): ?>
                                    <?php if($j['id_jenis'] == $broken->jenis_gabah){ ?>
                                        <option value="<?= $j['id_jenis'] ?>" selected><?= $j['nama_jenis'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                    <?php } ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                              
                        <div class="col-md-4">
                            <label for="">Tonase <span style="color: red;">(kg)</span></label>
                            <input type="text" value="<?= $broken->tonase ?>" required="" class="form-control tonase" id="tonase" name="tonase">
                        </div>
                              
                        <div class="col-md-4">
                            <label for="">Harga /kg</label>
                            <input type="text" value="<?= $broken->harga ?>" required="" class="form-control" id="harga_kg" name="harga_kg">
                        </div>
                        <input type="hidden" value="<?= $broken->total ?>" required="" class="total" name="total" id="total">
                   
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" class="form-control"><?= $broken->keterangan ?></textarea>
                        </div>
                    <button type="submit" class="btn btn-success mb-3"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                  </div>
                    </form>
                    
                </div>

              </div>
        </div>
      </div>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
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
