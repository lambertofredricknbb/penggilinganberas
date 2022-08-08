    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Data Pembelian
                                        <div class="page-title-subheading">Data Pembelian Beras Yang Sudah Diterima
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>            
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Tambah Pembelian</h5>
                                        <form action="<?= base_url('admin/proses_add_pembelian') ?>" method="post">
                                            <input type="hidden" required="" name="id_user" value="<?= $user['id_user'] ?>">
                                            <div class="form-group">
                                                <label for="">Kode Nota</label>
                                                <input type="text" required="" class="form-control" readonly name="kode_pembelian" id="kode_pembelian">
                                            </div><hr>
                                            <div class="form-group">
                                                <label for="">Nama Supplier</label>
                                                <input type="text" required="" class="form-control" name="nama_supplier">
                                            </div><hr>
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
                                            </div><hr>
                                            <div class="form-group">
                                                <div class="input_fields_wrap">
                                                    <button type="button" class="add_field_button btn btn-success"><i class="fas fa fa-plus"></i> Tambah</button><br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                        <label for="">Jenis Gabah</label>
                                                        <select name="jenis_gabah[]" required="" class="form-control" id="">
                                                            <option value="">-- Pilih Jenis --</option>
                                                            <?php foreach ($jenis as $j): ?>
                                                                <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="">Grade</label>
                                                        <select name="grade[]" required="" class="form-control" id="">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($grade as $g): ?>
                                                                <option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="">Tonase <span style="color: red;">(kg)</span></label>
                                                        <input type="text" required="" class="form-control tonase" id="tonase" name="tonase[]">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="">Harga /kg</label>
                                                        <input type="text" required="" class="form-control" id="harga_kg" name="harga_kg[]">
                                                    </div>
                                                    <input type="hidden" required="" class="total" name="total[]" id="total">
                                                    </div>
                                                </div>
                                            </div><hr>
                                            <div class="form-group">
                                                <label for="">No Penjemuran</label>
                                                <input type="text" class="form-control" required="" name="no_penjemuran">
                                            </div><hr>
                                            <div class="form-group">
                                                <label for="">Jenis Pengeringan</label>
                                                <select name="jenis_kering" class="form-control" id="">
                                                    <option value="">-- Pilih Jenis --</option>
                                                    <option value="Hasil Jemur">Hasil Jemur</option>
                                                    <option value="Pembelian">Pembelian</option>
                                                </select>
                                            </div><hr>

                                            <div class="form-group">
                                                <label for="">Keterangan</label>
                                                <textarea name="keterangan" required="" class="form-control"></textarea>
                                            </div>
                                            <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
                                            
                                            <input type="submit" class="btn btn-block btn-primary" value="simpan">
                                        </form>
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
            var max_fields = 3; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box incrementno
                    $(wrapper).append('<div class="row input">' + '<div class="col-md-4">' + 
                        '<label for="">Jenis Gabah</label>' + 
                        '<select name="jenis_gabah[]" id="jenis_gabah' + x + '" required="" class="form-control" id="">' + '<option value="">-- Pilih Jenis --</option>' +
                        <?php foreach ($jenis as $j): ?>
                            '<option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>' +
                        <?php endforeach ?>
                        '</select>' + 
                    '</div>' + 
                    '<div class="col-md-2">' + 
                        '<label for="">Grade</label>' + 
                        '<select name="grade[]" id="grade' + x + '" required="" class="form-control" id="">' + '<option value="">Pilih</option>' +
                        <?php foreach ($grade as $g): ?>
                            '<option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>' +
                        <?php endforeach ?>
                        '</select>' +  
                    '</div>' + 
                    '<div class="col-md-3">' + 
                        '<label for="">Tonase <span style="color: red;">(kg)</span></label>' + 
                        '<input type="text" class="form-control tonase" id="tonase' + x + '" name="tonase[]">' + 
                    '</div>' + 
                    '<div class="col-md-2">' + 
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
                    