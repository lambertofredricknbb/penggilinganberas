<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pembelian KS</li>
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
                      <h3 class="mb-0">Pembelian Gabah KS</h3>
                    </div>
                    <div class="col text-right">
                      <a href="<?= base_url('admin/print_excel') ?>" class="btn btn-success"><i class="fas fa fa-print"></i> Cetak Laporan</a>
                      <?php if($user['level'] == 1): ?>
                      <a href="#" data-toggle="modal" data-target="#ModalTambah" class="btn btn-primary"><i class="fas fa fa-plus"></i> Tambah Gabah</a>
                        <?php endif ?>
                      <!-- Modal -->
                      <div class="modal fade" id="ModalTambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Pembelian</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="<?= base_url('admin/proses_add_pembelian') ?>" method="post">
                              <div class="modal-body">
                                <input type="hidden" required="" name="id_user" value="<?= $user['id_user'] ?>">
                                <div class="row justify-content-left">
                                  <div class="col-md-12 text-left">
                                    
                                    <div class="row">
                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="">Kode Nota</label>
                                            <input type="text" required="" class="form-control" readonly name="kode_pembelian" id="kode_pembelian">
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="">Nama Supplier</label>
                                            <input type="text" required="" class="form-control" name="nama_supplier">
                                        </div>
                                      </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Nama Supir</label>
                                                <input type="text" required="" name="nama_supir" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Plat Kendaraan</label>
                                                <input type="text" required="" name="plat" id="plat" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="">Nama Musim</label>
                                              <select name="musim" class="form-control" id="">
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
                                                        <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                                 <div class="input_fields_wrap"> 
                                                     <button type="button" class="add_field_button btn btn-success"><i class="fas fa fa-plus"></i> Tambah</button><br> 
                                    <?php $x=1; ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Grade</label>
                                            <!--<input type="text" readonly="" value="<?= $g['nama_grade'] ?>" class="form-control">-->
                                            <!--<input type="hidden" readonly="" value="<?= $g['id_grade'] ?>" name="grade[]" class="form-control">-->
                                             <select name="grade[]" required="" class="form-control" id="">
                                                <option value="">Pilih</option>
                                                <?php foreach ($grade as $g): ?>
                                                    <option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">KA <span>%</span></label>
                                            <input type="text" class="form-control" name="ka[]">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Tonase <span style="color: red;">(kg)</span></label>
                                            <input type="text" value="0" class="form-control tonase" id="tonase<?= $x ?>" name="tonase[]">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Harga /kg</label>
                                            <input type="text" class="form-control" value="0" id="harga_kg<?= $x ?>" name="harga_kg[]">
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
                                    <?php $x++; ?>
                                                 </div> 
                                            </div><hr>
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
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No Nota</th>
                        <th>Nama Supplier</th>
                        <th>Plat / Nama Supir</th>
                        <th>Tonase</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pembelian as $p): ?>
                          <?php 
                          $this->db->select('SUM(tonase) as total_tonase');
                          $this->db->from('tb_pembelian');
                          $this->db->where('tb_pembelian.kode_pembelian', $p['kode_pembelian']);
                          $tonase = $this->db->get()->row()->total_tonase;

                          $this->db->select('SUM(total) as total_harga');
                          $this->db->from('tb_pembelian');
                          $this->db->where('tb_pembelian.kode_pembelian', $p['kode_pembelian']);
                          $total_harga = $this->db->get()->row()->total_harga;
                           ?>
                      <tr>
                          <th scope="row"><?= $p['kode_pembelian'] ?></th>
                          <td><?= $p['nama_supplier'] ?></td>
                          <td><?= $p['plat'] ?> / <?= $p['nama_supir'] ?></td>
                          <td class="text-center"><?= $tonase ?> KG</td>
                          <td class="text-center">Rp. <?= number_format($total_harga, 0,'.','.') ?></td>
                          <td>
                              <a href="<?= base_url('admin/detail_pembelian/').$p['kode_pembelian'] ?>" class="btn btn-success"><i class="fas fa-search"></i></a>
                               <a href="<?= base_url('admin/hapus_pembelian/').$p['kode_pembelian'] ?>" class="btn btn-danger"><i class="fas fa fa-trash"></i></a> 
                               <a href="<?= base_url('admin/edit_pembelian/').$p['kode_pembelian'] ?>" class="btn btn-primary"><i class="fas fa fa-edit"></i></a> 
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
 
<script type="text/javascript">
    // kode pembelian
    $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>admin/getKode',
                beforeSend: function() {
                    $('.loading').show();
                },
                success: function(data) {

                    var html = JSON.parse(data);
                    var kode = 'PB_' + html;
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
    // tambah input
    $(document).ready(function() {
            var max_fields = 5; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box incrementno
                    $(wrapper).append('<div class="row input">' + 
                    '<div class="col-md-3">' + 
                        '<label for="">Grade</label>' + 
                        '<select name="grade[]" id="grade' + x + '" required="" class="form-control" id="">' + '<option value="">Pilih</option>' +
                        <?php foreach ($grade as $g): ?>
                            '<option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>' +
                        <?php endforeach ?>
                        '</select>' +  
                    '</div>' + 
                    '<div class="col-md-2">' + 
                        '<label for="">KA</span></label>' + 
                        '<input type="text" class="form-control tonase" id="ka' + x + '" name="ka[]">' + 
                    '</div>' + 
                    '<div class="col-md-3">' + 
                        '<label for="">Tonase <span style="color: red;">(kg)</span></label>' + 
                        '<input type="text" class="form-control tonase" id="tonase' + x + '" name="tonase[]">' + 
                    '</div>' + 
                    '<div class="col-md-3">' + 
                        '<label for="">Harga /kg</label>' + 
                        '<input type="text" class="form-control" id="harga_kg' + x + '" name="harga_kg[]">' + 
                    '</div>' +
                    '<input type="hidden" name="total[]" class="total" id="total' + x + '">' + 
                        '<br>' +
                        '<a href="#" class="btn btn-danger remove_field my-2"><i class="fas fa fa-trash"></a>' + 
                    '</div>'); //add input box

                    $('#tonase' + x).keyup(function(){
                        var tonase = $('#tonase' + x).val();
                        var harga_kg = $('#harga_kg' + x).val();
                        var total = Number(tonase) * Number(harga_kg)
                        $('#total' + x).val(total);
                    });
                    $('#harga_kg' + x).keyup(function(){
                        var tonase = $('#tonase' + x).val();
                        var harga_kg = $('#harga_kg' + x).val();
                        var total = Number(tonase) * Number(harga_kg)
                        $('#total' + x).val(total);
                    });
                    
                    // $('#anggota' + x).autocomplete({
                    //     source: "<?php echo site_url('admin/getDosen'); ?>",
                    //     select: function(event, ui) {
                    //         $('#id_anggota' + x).val(ui.item.id_dosen);
                    //         $('#anggota' + x).val(ui.item.description);
                    //     }
                    // });
                }
            });
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })

        });

</script>