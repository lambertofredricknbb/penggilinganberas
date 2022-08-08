<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data Grade</li>
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
                      <h3 class="mb-0">Data Grade</h3>
                    </div>
                    <div class="col text-right">
                        <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahUser" class="btn btn-success"><i class="fas fa fa-plus"></i> Tambah</a>

                        <!-- Modal -->
                        <div class="modal fade" id="tambahUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-md">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Grade</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="<?= base_url('admin/add_grade') ?>" method="post">
                                  <div class="modal-body text-left">
                                    <div class="form-group">
                                        <label for="">Nama Grade</label>
                                        <input type="text" required="" class="form-control" name="grade">
                                    </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <?php if($this->session->flashdata('err_msg')){ ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('err_msg'); ?></div>
                <?php } ?>
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>Nama Grade</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;foreach ($grade as $g): ?>
                          <tr class="text-center">
                            <td><b><?= $i ?></b></td>
                            <td><?= $g['nama_grade'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/delete_grade/') . $g['id_grade']; ?>" class="btn btn-danger"><i class="fas fa fa-trash"></i></a>
                                <a href="<?= base_url('admin/edit_grade/') . $g['id_grade']; ?>" class="btn btn-success"><i class="fas fa fa-pen"></i></a>
                            </td>
                          </tr>
                      <?php $i++; endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
      <!-- </div> -->
