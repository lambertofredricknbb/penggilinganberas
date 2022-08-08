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
                    <?php if ($d['status'] == 2): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success text-center" role="alert">
                                  <b>DETAIL PROSES KEBI</b>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span><b>Tanggal Selesai</b></span><br>
                                        <span><b>Nama Admin</b></span><br>
                                    </div>
                                    <div class="col-md-6">
                                        <span>: <?= tgl_indo(date('Y-m-d', strtotime($d['tanggal']))) ?></span><br>
                                        <span>: <?= $d['username'] ?></span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span><b>Kode Kebi</b></span><br>
                                        <span><b>Tanggal Selesai</b></span><br>
                                    </div>
                                    <div class="col-md-6">
                                        <?php 
                                        $tanggal = date('Y-m-d', strtotime($d['tanggal']));
                                         ?>
                                        : <span style="font-weight:  700; color: #f1c40f; "> <?= $d['kode_kebi'] ?></span><br>
                                        <span>: <?= tgl_indo($tanggal) ?></span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12">
                                <table class="table table-bordered align-items-center">
                                  <thead>
                                    <tr class="text-center">
                                      <th rowspan="2" scope="col"><b>No</b></th>
                                      <th rowspan="2" scope="col"><b>Nama Merk</b></th>
                                      <th colspan="4" scope="col"><b>Jumlah Kemasan</b></th>
                                      <th rowspan="2" scope="col"><b>Total</b></th>
                                    </tr>
                                    <tr class="text-center">
                                      <th scope="col"><b>5 Kg</b></th>
                                      <th scope="col"><b>10 Kg</b></th>
                                      <th scope="col"><b>25 Kg</b></th>
                                      <th scope="col"><b>50 Kg</b></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $this->db->select('*');
                                      $this->db->from('tb_hasil_kebi');
                                      $this->db->join('merk_beras', 'tb_hasil_kebi.merk = merk_beras.id_merk');
                                      $this->db->where('tb_hasil_kebi.kode_kebi', $d['kode_kebi']);
                                      $result = $this->db->get()->result_array();
                                      ?>
                                      <?php $i=1; foreach($result as $s): ?>
                                        <?php $total = $s['5kg'] + $s['10kg'] + $s['25kg'] + $s['50kg']; ?>
                                          <tr class="text-center">
                                              <td><?= $i ?></td>
                                              <td><?= $s['nama_merk'] ?></td>
                                              <td><?= $s['5kg'] ?></td>
                                              <td><?= $s['10kg'] ?></td>
                                              <td><?= $s['25kg'] ?></td>
                                              <td><?= $s['50kg'] ?></td>
                                              <td><?= $total ?></td>
                                          </tr>
                                      <?php $i++; endforeach ?>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if ($d['status'] == 1): ?>
                        <h2>Hasil Proses Kebi</h2>
                        <form action="<?= base_url('admin/add_hasil_kebi') ?>" method="post">
                            <input type="hidden" id="batas" value="<?= $d['tonase'] ?>" class="form-control">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Kode Kebi</label>
                                        <input type="text" class="form-control" readonly="" name="kode_kebi" value="<?= $d['kode_kebi'] ?>">
                                    </div>
                                </div>
                                <?php
                                $this->db->select('SUM(tonase) as total_tonase');
                                $this->db->from('tb_kebi');
                                $this->db->where('tb_kebi.kode_kebi', $d['kode_kebi']);
                                $tonase = $this->db->get()->row()->total_tonase;
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Berat Beras</label>
                                        <input type="text" class="form-control" readonly="" value="<?= $tonase ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Hasil Menir Kebi</label>
                                        <input type="text" class="form-control" id="menir" name="menir_kebi">
                                    </div>
                                </div>
                            </div>
                            <div class="row input_fields_wrap">
                                <div class="col-md-12">
                                    <button type="button" class="add_field_button btn btn-success"><i class="fas fa fa-plus"></i> Tambah</button>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Merek :</label>
                                        <select name="merk[]" class="form-control" id="">
                                            <option value="">-- Pilih --</option>   
                                            <?php foreach ($merk as $m): ?>
                                                <option value="<?= $m['id_merk'] ?>"><?= $m['nama_merk'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">5 Kg :</label>
                                        <input type="text" id="5kg" class="form-control" name="5kg[]">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">10 Kg :</label>
                                        <input type="text" id="10kg" class="form-control" name="10kg[]">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">25 Kg :</label>
                                        <input type="text" id="25kg" class="form-control" name="25kg[]">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">50 Kg :</label>
                                        <input type="text" id="50kg" class="form-control" name="50kg[]">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary btn-block my-2" value="Simpan">
                        </form>
                    <?php endif ?>
                <?php endforeach ?>
                <?php if ($d['status'] == 1): ?>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <table class="table table-bordered align-items-center">
                                  <thead>
                                    <tr class="text-center">
                                      <th rowspan="2" scope="col"><b>No</b></th>
                                      <th rowspan="2" scope="col"><b>Nama Merk</b></th>
                                      <th colspan="4" scope="col"><b>Jumlah Kemasan</b></th>
                                      <th rowspan="2" scope="col"><b>Tanggal</b></th>
                                    </tr>
                                    <tr class="text-center">
                                      <th scope="col"><b>5 Kg</b></th>
                                      <th scope="col"><b>10 Kg</b></th>
                                      <th scope="col"><b>25 Kg</b></th>
                                      <th scope="col"><b>50 Kg</b></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $this->db->select('*');
                                      $this->db->from('tb_hasil_kebi');
                                      $this->db->join('merk_beras', 'tb_hasil_kebi.merk = merk_beras.id_merk');
                                      $this->db->where('tb_hasil_kebi.kode_kebi', $d['kode_kebi']);
                                      $result = $this->db->get()->result_array();
                                      ?>
                                      <?php $i=1; foreach($result as $s): ?>
                                        <?php $total = $s['5kg'] + $s['10kg'] + $s['25kg'] + $s['50kg']; ?>
                                          <tr class="text-center">
                                              <td><?= $i ?></td>
                                              <td><?= $s['nama_merk'] ?></td>
                                              <td><?= $s['5kg'] ?></td>
                                              <td><?= $s['10kg'] ?></td>
                                              <td><?= $s['25kg'] ?></td>
                                              <td><?= $s['50kg'] ?></td>
                                              <td><?= tgl_indo(date('Y-m-d', strtotime($s['tanggal']))) ?></td>
                                          </tr>
                                      <?php $i++; endforeach ?>
                                  </tbody>
                                </table><br><br>
                                <?php foreach ($detail as $d): ?>
                                <form action="<?= base_url('admin/selesai_kebi') ?>" method="post">
                                    <input type="hidden" name="kode_kebi" value="<?= $d['kode_kebi'] ?>">
                                    <input type="submit" class="btn btn-block btn-success" value="Selesai">
                                </form>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif ?>
            </div>
        </div>
        </div>
      </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

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
                    $(wrapper).append('<div class="container"><div class="row input">' + 
                    '<div class="col-md-3">' + 
                        '<label for="">Merk</label>' + 
                        '<select name="merk[]" id="merk' + x + '" required="" class="form-control" id="">' + '<option value="">Pilih</option>' +
                        <?php foreach ($merk as $m): ?>
                            '<option value="<?= $m['id_merk'] ?>"><?= $m['nama_merk'] ?></option>' +
                        <?php endforeach ?>
                        '</select>' +  
                    '</div>' + 
                    '<div class="col-md-2">' + 
                        '<label for="">5 Kg</label>' + 
                        '<input type="text" id="5kg" required class="form-control" name="5kg[]">'
                        +  
                    '</div>' + 
                    '<div class="col-md-2">' + 
                        '<label for="">10 Kg</label>' + 
                        '<input type="text" required id="10kg" class="form-control" name="10kg[]">'
                        +  
                    '</div>' +
                    '<div class="col-md-2">' + 
                        '<label for="">25 Kg</label>' + 
                        '<input type="text" required id="25kg" class="form-control" name="25kg[]">'
                        +  
                    '</div>' +
                    '<div class="col-md-2">' + 
                        '<label for="">50 Kg</label>' + 
                        '<input type="text" required id="50kg" class="form-control" name="50kg[]">'
                        +  
                    '</div>' +
                        '<br>' +
                        '<a href="#" class="btn btn-danger remove_field my-2"><i class="fas fa fa-trash"></a>' + 
                    '</div></div>'); //add input box

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
        
//         $("#5kg").keyup(function () {
// 			var b5 = $("#5kg").val();
// 			var b10 = $("#10kg").val();
// 			var b25 = $("#25kg").val();
// 			var b50 = $("#50kg").val();
// 			var batas = $("#batas").val();
// 			var totall = (Number(b5) * 5) + (Number(b10) * 10) + (Number(b25) * 25) + (Number(b50) * 50);
// 			console.log(totall);
// 			if (totall > batas) {
// 				alert('Nilai bobot tidak boleh melebihi berat beras');
// 			}
// 		});
// 		$("#10kg").keyup(function () {
// 			var b5 = $("#5kg").val();
// 			var b10 = $("#10kg").val();
// 			var b25 = $("#25kg").val();
// 			var b50 = $("#50kg").val();
// 			var batas = $("#batas").val();
// 			var totall = (Number(b5) * 5) + (Number(b10) * 10) + (Number(b25) * 25) + (Number(b50) * 50);
// 			console.log(totall);
// 			if (totall > batas) {
// 				alert('Nilai bobot tidak boleh melebihi berat beras');
// 			}
// 		});
// 		$("#25kg").keyup(function () {
// 			var b5 = $("#5kg").val();
// 			var b10 = $("#10kg").val();
// 			var b25 = $("#25kg").val();
// 			var b50 = $("#50kg").val();
// 			var batas = $("#batas").val();
// 			var totall = (Number(b5) * 5) + (Number(b10) * 10) + (Number(b25) * 25) + (Number(b50) * 50);
// 			console.log(totall);
// 			if (totall > batas) {
// 				alert('Nilai bobot tidak boleh melebihi berat beras');
// 			}
// 		});
// 		$("#50kg").keyup(function () {
// 			var b5 = $("#5kg").val();
// 			var b10 = $("#10kg").val();
// 			var b25 = $("#25kg").val();
// 			var b50 = $("#50kg").val();
// 			var batas = $("#batas").val();
// 			var totall = (Number(b5) * 5) + (Number(b10) * 10) + (Number(b25) * 25) + (Number(b50) * 50);
// 			console.log(totall);
// 			if (totall > batas) {
// 				alert('Nilai bobot tidak boleh melebihi berat beras');
// 			}
// 		});


    
</script>