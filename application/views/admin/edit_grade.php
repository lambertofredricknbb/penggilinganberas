<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Grade</li>
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
                      <h3 class="mb-0">Edit Grade</h3>
                    </div>
                    <div class="col text-right">
                    </div>
                  </div>
                </div>
                <div class="container">
                 
                  <form action="<?= base_url('admin/edit_grade/') . $grade->id_grade; ?>" method="post">
                    <div class="form-group">
                      <label for="">Nama Grade</label><br>
                      <?= form_error('grade','<small class="text-danger">','</small>'); ?>
                      <input type="text" name="grade" class="form-control" value="<?= $grade->nama_grade; ?>">
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-success"><br><br>
                  </form>
           
                </div>

              </div>
        </div>
      </div>