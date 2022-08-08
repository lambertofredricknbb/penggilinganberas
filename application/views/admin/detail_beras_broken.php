<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                  <div class="row">
                     <div class="col-lg-6">
                         <p><b>Tanggal</b> : <?= $broken->tanggal ?></p>
                         <p><b>Nama Supplier</b> : <?= $broken->nama_supplier ?></p>
                         <p><b>Kendaraan</b> : <?= $broken->nama_supir ?> / <?= $broken->plat_kendaraan ?></p>
                     </div>
                     <div class="col-lg-6">
                         <p><b>No Nota</b> : <?= $broken->kode_nota ?></p>
                         <p><b>Barang</b> : </p>
                     </div>
                     <div class="col-lg-12">
                         <table class="table table-bordered">
                             <thead>
                                 <tr>
                                     <td>Nama Barang</td>
                                     <td>Tonase</td>
                                     <td>Harga / Kg</td>
                                     <td>Total</td>
                                 </tr>
                             </thead>
                            <tbody>
                                <tr>
                                    <td><?= $broken->nama_jenis; ?></td>
                                    <td><?= $broken->tonase ?></td>
                                    <td>Rp. <?= number_format($broken->harga); ?></td>
                                    <td>Rp. <?= number_format($broken->total); ?></td>
                                </tr>
                            </tbody>
                         </table>
                         <h5>Keterangan : </h5>
                         <p><?= $broken->keterangan ?></p>
                         <br>
                     </div>
                  </div>
                </div>

              </div>
        </div>
      </div>