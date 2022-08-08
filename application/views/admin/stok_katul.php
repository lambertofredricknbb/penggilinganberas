<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Stok Katul</li>
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
                      <h3 class="mb-0">Data Stok Katul dan Menir</h3>
                    </div>
                    <div class="col text-right">
                        <a href="#" data-toggle="modal" data-target="#jual_stok" class="btn btn-primary">+ Jual Stok</a>
                        <!-- Modal -->
                        <div class="modal fade" id="jual_stok" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Jual Stok</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="<?= base_url('admin/jual_stok') ?>" method="post">
                              <div class="modal-body">
                                <div class="row justify-content-left">
                                    <div class="col-md-12 text-left">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Jenis Hasil</label>
                                        <select class="form-control" required name="jenis_hasil">
                                            <option value="1">Menir</option>
                                            <option value="2">Katul</option>
                                            <option value="3">Menir Kebi</option>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Jumlah : <span style="color: red;">(*kg)</span></label>
                                        <input type="text" name="jumlah" required class="form-control" id="exampleInputPassword1">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Total Harga :</label>
                                        <input type="text" name="total_harga" required class="form-control" id="exampleInputPassword1">
                                      </div>
                                    </div>
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
                <div class="table-responsive my-3">
                  <!-- Projects table -->
                  <table class="table align-items-center table-bordered">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>Katul Giling</th>
                        <th>Menir Giling</th>
                        <th>Menir Kebi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;?>
                      <?php
                        $this->db->select('*');
                        $this->db->from('tb_hasil_giling');
                        $this->db->where('id_hasil', 2);
                        $this->db->limit(1);
                        $kgiling = $this->db->get()->result_array();

                        $this->db->select('*');
                        $this->db->from('tb_hasil_giling');
                        $this->db->where('id_hasil', 1);
                        $this->db->limit(1);
                        $mgiling = $this->db->get()->result_array();

                        $this->db->select('*');
                        $this->db->from('tb_hasil_giling');
                        $this->db->where('id_hasil', 3);
                        $this->db->limit(1);
                        $mkebi = $this->db->get()->result_array();
                      ?>
                          <tr class="text-center">
                            <td><b><?= $i ?></b></td>
                            <?php foreach($kgiling as $k): ?>
                            <td><?= $k['jumlah'] ?> Sak</td>
                            <?php endforeach ?>
                            <?php foreach($mgiling as $m): ?>
                            <td><?= $m['jumlah'] ?> Kg</td>
                            <?php endforeach ?>
                            <?php foreach($mkebi as $mk): ?>
                            <td><?= $mk['jumlah'] ?> Kg</td>
                            <?php endforeach ?>
                          </tr>
                      <?php $i++;?>
                      <tr class="text-center" style="background: #dff9fb;">
                        <td>#</td>
                        <td>
                          <div class="row">
                            <div class="col-md-6 text-left">
                              Total Katul :
                            </div>
                            <div class="col-md-6 text-right">
                                <?php foreach($kgiling as $k): ?>
                                    <b><?= $k['jumlah'] ?> Sak</b>
                                <?php endforeach ?>
                            </div>
                          </div>
                        </td>
                        <td colspan="2">
                          <div class="row">
                            <div class="col-md-6 text-left">
                              Total Menir :
                            </div>
                            <div class="col-md-6 text-right">
                                <?php foreach($mkebi as $mk){
                                    $kebi = $mk['jumlah'];
                                }?>
                                <?php foreach($mgiling as $m): ?>
                                    <b><?= $m['jumlah'] + $kebi ?> Kg</b>
                                <?php endforeach ?>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              
              
              
              
              
              <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Data Penjualan Stok</h3>
                    </div>
                    <div class="col text-right">
                    </div>
                  </div>
                </div>
                <div class="table-responsive my-3">
                  <!-- Projects table -->
                  <table class="table align-items-center table-bordered">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>Jenis Stok</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach($jual_stok as $js): ?>
                      <tr class="text-center">
                          <td><?= $i ?></td>
                          <?php if($js['jenis_hasil'] == 1): ?>
                            <td>Menir</td>
                          <?php endif ?>
                          <?php if($js['jenis_hasil'] == 2): ?>
                            <td>Katul</td>
                          <?php endif ?>
                          <?php if($js['jenis_hasil'] == 3): ?>
                            <td>Menir Kebi</td>
                          <?php endif ?>
                          <td><?= $js['jumlah'] ?> Kg</td>
                          <td>Rp. <?= number_format($js['total_harga'], 0,'.','.') ?></td>
                      </tr>
                      <?php $i++; endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
      </div>
