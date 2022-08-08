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
                  <li class="breadcrumb-item active" aria-current="page">Proses Kebi</li>
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
                      <h3 class="mb-0">Proses Kebi</h3>
                    </div>
                    <div class="col text-right">
                      <!-- Button trigger modal -->
                      <?php if($user['level'] == 1): ?>
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">
                        <i class="fas fa fa-plus"></i> Tambah Kebi
                      </button>
                      <?php endif ?>

                      <!-- Modal -->
                      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Tambah Proses KEBI</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="<?= base_url('admin/add_kebi') ?>" method="post">
                              <div class="modal-body text-left">
                                <div class="form-group">
                                  <label for="">Kode KEBI :</label>
                                  <input type="text" class="form-control" readonly="" name="kode_kebi" id="kode_kebi">
                                </div>
                                <div class="row input_fields_wrap">
                                  <div class="col-md-12">
                                    <button type="button" class="add_field_button btn btn-success"><i class="fas fa fa-plus"></i> Tambah</button>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Musim :</label>
                                      <select name="musim[]" class="form-control" id="">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                          $this->db->select('*');
                                          $this->db->from('tb_stok_proses_giling');
                                          $this->db->where('tb_stok_proses_giling.hasil_beras > 0');
                                          $this->db->group_by('tb_stok_proses_giling.musim');
                                          $musim = $this->db->get()->result_array();
                                          ?>
                                          <?php foreach ($musim as $m): ?>
                                            <option value="<?= $m['musim'] ?>"><?= $m['musim'] ?></option>
                                          <?php endforeach ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Jenis :</label>
                                      <select name="jenis[]" class="form-control" id="">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                          $this->db->select('*');
                                          $this->db->from('tb_stok_proses_giling');
                                          $this->db->join('jenis_beras', 'tb_stok_proses_giling.jenis = jenis_beras.id_jenis');
                                          $this->db->join('grade', 'tb_stok_proses_giling.grade = grade.id_grade');
                                          $this->db->group_by('tb_stok_proses_giling.jenis');
                                          $this->db->where('tb_stok_proses_giling.hasil_beras > 0');
                                          // $this->db->group_by('tb_stok_kg.grade');
                                          $this->db->order_by('tb_stok_proses_giling.tanggal', 'DESC');
                                          $jenis = $this->db->get()->result_array();
                                          ?>
                                          <?php foreach ($jenis as $je): ?>
                                            <option value="<?= $je['id_jenis'] ?>"><?= $je['nama_jenis'] ?></option>
                                          <?php endforeach ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Grade :</label>
                                      <select name="grade[]" class="form-control" id="">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                          $this->db->select('*');
                                          $this->db->from('tb_stok_proses_giling');
                                          $this->db->join('jenis_beras', 'tb_stok_proses_giling.jenis = jenis_beras.id_jenis');
                                          $this->db->join('grade', 'tb_stok_proses_giling.grade = grade.id_grade');
                                          // $this->db->group_by('tb_stok_kg.jenis');
                                          $this->db->group_by('tb_stok_proses_giling.grade');
                                          $this->db->order_by('tb_stok_proses_giling.tanggal', 'DESC');
                                          $this->db->where('tb_stok_proses_giling.hasil_beras > 0');
                                          $grade = $this->db->get()->result_array();
                                          ?>
                                          <?php foreach ($grade as $gr): ?>
                                            <option value="<?= $gr['id_grade'] ?>"><?= $gr['nama_grade'] ?></option>
                                          <?php endforeach ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Tonase :</label>
                                      <input type="text" class="form-control" name="tonase[]">
                                    </div>
                                  </div>
                                </div>
                               
                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Proses</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="container">
                <div class="table-responsive my-3">
                  <!-- Projects table -->
                  <table class="table table-bordered table-striped align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <!-- <th rowspan="2"><b>Tanggal</b></th> -->
                        <th rowspan="2"><b>Kode Kebi</b></th>
                        <th colspan="4"><b>Input Bahan</b></th>
                        <th rowspan="2"><b>Keterangan</b></th>
                        <?php if($user['level'] == 1): ?>
                        <th rowspan="2"><b>Aksi</b></th>
                        <?php endif ?>
                      </tr>
                      <tr class="text-center">
                        <th>Musim</th>
                        <th>Jenis</th>
                        <th>Grade</th>
                        <th>Tonase</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($kebi as $k): ?>
                      <tr class="text-center">
                        <!-- <td><?= tgl_indo(date('Y-m-d', strtotime($k['tanggal']))) ?></td> -->
                        <td><b><?= $k['kode_kebi'] ?></b></td>
                        <?php
                        $this->db->select('*');
                        $this->db->from('tb_kebi');
                        $this->db->join('tb_user', 'tb_kebi.id_user = tb_user.id_user');
                        $this->db->join('jenis_beras', 'tb_kebi.jenis = jenis_beras.id_jenis');
                        $this->db->join('grade', 'tb_kebi.grade = grade.id_grade');
                        $this->db->where('tb_kebi.kode_kebi', $k['kode_kebi']);
                        $uraian = $this->db->get()->result_array();
                         ?>
                         <td class="text-center">
                           <table>
                             <?php foreach ($uraian as $u): ?>
                               <tr class="text-center">
                                 <td class="text-center"><?= $u['musim'] ?></td>
                               </tr>
                               <?php endforeach ?>
                           </table>
                         </td>
                         <td class="text-center">
                           <table>
                             <?php foreach ($uraian as $u): ?>
                               <tr class="text-center">
                                 <td class="text-center"><?= $u['nama_jenis'] ?></td>
                               </tr>
                               <?php endforeach ?>
                           </table>
                         </td>
                         <td>
                           <table>
                             <?php foreach ($uraian as $u): ?>
                               <tr>
                                 <td><?= $u['nama_grade'] ?></td>
                               </tr>
                               <?php endforeach ?>
                           </table>
                         </td>
                         <td>
                           <table>
                             <?php foreach ($uraian as $u): ?>
                               <tr>
                                 <td><?= $u['tonase'] ?></td>
                               </tr>
                               <?php endforeach ?>
                           </table>
                         </td>
                         <td class="text-center">
                           <?php if ($k['status'] == 1): ?>
                             <span class="badge badge-pill badge-warning">Belum Selesai</span>
                           <?php endif ?>
                           <?php if ($k['status'] == 2): ?>
                             <span class="badge badge-pill badge-success">Selesai</span>
                           <?php endif ?>
                         </td>  
                         <?php if($user['level'] == 1): ?>
                         <td class="text-center">
                           <a href="<?= base_url('admin/detail_kebi/').$k['kode_kebi'] ?>" class="btn btn-success"><i class="fas fa fa-search"></i></a>
                         </td>
                         <?php endif ?>
                      </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                  
                </div>
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
            $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>admin/getKodeKebi',
                beforeSend: function() {
                    $('.loading').show();
                },
                success: function(data) {

                    var html = JSON.parse(data);
                    var kode = 'KEBI_' + html;
                    var nodaf = kode;
                    $('#kode_kebi').val(nodaf);
                }
            });

            // 
            $("#beras_50").keyup(function () {
              var beras = $("#berate").val()
              var b5 = $("#beras_5").val();
              var b10 = $("#beras_10").val();
              var b25 = $("#beras_25").val();
              var b50 = $("#beras_50").val();
              var totall = Number(b5) + Number(b10) + Number(b25) + Number(b50);
              console.log(totall);
              if (totall > beras) {
                alert('Berat tidak boleh melebihi beras yang dimasukkan');
                // $("#beras_50").val(beras / 4);
              }
            });
            $("#beras_25").keyup(function () {
              var beras = $("#berate").val()
              var b5 = $("#beras_5").val();
              var b10 = $("#beras_10").val();
              var b25 = $("#beras_25").val();
              var b50 = $("#beras_50").val();
              var totall = Number(b5) + Number(b10) + Number(b25) + Number(b50);
              console.log(totall);
              if (totall > beras) {
                alert('Berat tidak boleh melebihi beras yang dimasukkan');
                // $("#beras_25").val(beras / 4);
              }
            });
            $("#beras_10").keyup(function () {
              var beras = $("#berate").val()
              var b5 = $("#beras_5").val();
              var b10 = $("#beras_10").val();
              var b25 = $("#beras_25").val();
              var b50 = $("#beras_50").val();
              var totall = Number(b5) + Number(b10) + Number(b25) + Number(b50);
              console.log(totall);
              if (totall > beras) {
                alert('Berat tidak boleh melebihi beras yang dimasukkan');
                // $("#beras_10").val(beras / 4);
              }
            });
            $("#beras_5").keyup(function () {
              var beras = $("#berate").val()
              var b5 = $("#beras_5").val();
              var b10 = $("#beras_10").val();
              var b25 = $("#beras_25").val();
              var b50 = $("#beras_50").val();
              var totall = Number(b5) + Number(b10) + Number(b25) + Number(b50);
              console.log(totall);
              if (totall > beras) {
                alert('Berat tidak boleh melebihi beras yang dimasukkan');
                // $("#beras_5").val(beras / 4);
              }
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
                    $(wrapper).append('<div class="container"><div class="row input">' + 
                    '<div class="col-md-3">' + 
                        '<label for="">Musim</label>' + 
                        '<select name="musim[]" id="musim' + x + '" required="" class="form-control" id="">' + '<option value="">Pilih</option>' +
                        <?php
                          $this->db->select('*');
                          $this->db->from('tb_giling');
                          $this->db->join('jenis_beras', 'tb_giling.jenis = jenis_beras.id_jenis');
                          $this->db->join('grade', 'tb_giling.grade = grade.id_grade');
                          // $this->db->group_by('tb_stok_kg.jenis');
                          $this->db->where('tb_giling.hasil_beras > 0');
                          $this->db->group_by('tb_giling.musim');
                          $musim = $this->db->get()->result_array();
                          ?>
                        <?php foreach ($musim as $m): ?>
                            '<option value="<?= $m['musim'] ?>"><?= $m['musim'] ?></option>' +
                        <?php endforeach ?>
                        '</select>' +  
                    '</div>' + 
                    '<div class="col-md-3">' + 
                        '<label for="">Jenis</label>' + 
                        '<select name="jenis[]" id="jenis' + x + '" required="" class="form-control" id="">' + '<option value="">Pilih</option>' +
                        <?php
                          $this->db->select('*');
                          $this->db->from('tb_giling');
                          $this->db->join('jenis_beras', 'tb_giling.jenis = jenis_beras.id_jenis');
                          $this->db->join('grade', 'tb_giling.grade = grade.id_grade');
                          $this->db->group_by('tb_giling.jenis');
                          $this->db->where('tb_giling.hasil_beras > 0');
                          // $this->db->group_by('tb_stok_kg.grade');
                          $this->db->order_by('tb_giling.tanggal', 'DESC');
                          $jenis = $this->db->get()->result_array();
                          ?>
                        <?php foreach ($jenis as $j): ?>
                            '<option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>' +
                        <?php endforeach ?>
                        '</select>' +  
                    '</div>' + 
                    '<div class="col-md-3">' + 
                        '<label for="">Grade</label>' + 
                        '<select name="grade[]" id="grade' + x + '" required="" class="form-control" id="">' + '<option value="">Pilih</option>' +
                        <?php
                          $this->db->select('*');
                          $this->db->from('tb_giling');
                          $this->db->join('jenis_beras', 'tb_giling.jenis = jenis_beras.id_jenis');
                          $this->db->join('grade', 'tb_giling.grade = grade.id_grade');
                          // $this->db->group_by('tb_stok_kg.jenis');
                          $this->db->group_by('tb_giling.grade');
                          $this->db->order_by('tb_giling.tanggal', 'DESC');
                          $this->db->where('tb_giling.hasil_beras > 0');
                          $grade = $this->db->get()->result_array();
                          ?>
                        <?php foreach ($grade as $g): ?>
                            '<option value="<?= $g['id_grade'] ?>"><?= $g['nama_grade'] ?></option>' +
                        <?php endforeach ?>
                        '</select>' +  
                    '</div>' + 
                    '<div class="col-md-2">' + 
                        '<label for="">Tonase <span style="color: red;">(kg)</span></label>' + 
                        '<input type="text" class="form-control tonase" id="tonase' + x + '" name="tonase[]">' + 
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


        });


        </script>