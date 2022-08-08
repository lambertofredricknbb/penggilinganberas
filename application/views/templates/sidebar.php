
<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="<?= base_url('assets/logo.png') ?>" style="width: 75%; height: 90%;" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'index' || $this->uri->segment(2) == false){ echo "active"; }?>" href="<?= base_url('admin/index') ?>">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'profil'){ echo "active"; }?>" href="<?= base_url('admin/profil') ?>">
                <i class="ni ni-circle-08 text-primary"></i>
                <span class="nav-link-text">Profil</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'pembelian'){ echo "active"; }?>" href="<?= base_url('admin/pembelian') ?>">
                <i class="ni ni-app text-primary"></i>
                <span class="nav-link-text">Pembelian Gabah KS</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'stok_ks'){ echo "active"; }?>" href="<?= base_url('admin/stok_ks') ?>">
                <i class="ni ni-app text-primary"></i>
                <span class="nav-link-text">Stok Gabah KS</span>
              </a>
            </li>
            <?php if($user['level'] == 1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'proses_pengeringan'){ echo "active"; }?>" href="<?= base_url('admin/proses_pengeringan') ?>">
                <i class="ni ni-map-big text-primary"></i>
                <span class="nav-link-text">Proses Pengeringan</span>
              </a>
            </li>
            <?php endif ?>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'stock_siap_giling'){ echo "active"; }?>" href="<?= base_url('admin/stock_siap_giling') ?>">
                <i class="ni ni-bag-17 text-primary"></i>
                <span class="nav-link-text">Stock Kering Giling</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'proses_giling'){ echo "active"; }?>" href="<?= base_url('admin/proses_giling') ?>">
                <i class="ni ni-vector text-primary"></i>
                <span class="nav-link-text">Proses Giling</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'stok_beras_giling'){ echo "active"; }?>" href="<?= base_url('admin/stok_beras_giling') ?>">
                <i class="ni ni-archive-2 text-primary"></i>
                <span class="nav-link-text">Stok Beras Giling</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'proses_kebi'){ echo "active"; }?>" href="<?= base_url('admin/proses_kebi') ?>">
                <i class="ni ni-box-2 text-primary"></i>
                <span class="nav-link-text">Proses KEBI</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'stok_katul'){ echo "active"; }?>" href="<?= base_url('admin/stok_katul') ?>">
                <i class="ni ni-app text-primary"></i>
                <span class="nav-link-text">Stok Menir & Katul</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'stok_merk'){ echo "active"; }?>" href="<?= base_url('admin/stok_merk') ?>">
                <i class="ni ni-app text-primary"></i>
                <span class="nav-link-text">Stok Merk Beras</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'broken'){ echo "active"; }?>" href="<?= base_url('admin/broken') ?>">
                <i class="ni ni-app text-primary"></i>
                <span class="nav-link-text">Stok Beras Broken</span>
              </a>
            </li>
          </ul>
          <hr class="my-2">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Data Penggilingan</span>
          </h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'jenis_beras'){ echo "active"; }?>" href="<?= base_url('admin/jenis_beras') ?>">
                <i class="ni ni-tag"></i>
                <span class="nav-link-text">Data Jenis</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'merk_beras'){ echo "active"; }?>" href="<?= base_url('admin/merk_beras') ?>">
                <i class="ni ni-tie-bow"></i>
                <span class="nav-link-text">Data Merk</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'grade'){ echo "active"; }?>" href="<?= base_url('admin/grade') ?>">
                <i class="fas fa-ribbon"></i>
                <span class="nav-link-text">Data Grade</span>
              </a>
            </li>
            
          </ul>
          <!-- Divider -->
          <hr class="my-1">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Akun</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <?php if($user['level'] == 2): ?>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment(2) == 'data_user'){ echo "active"; }?>" href="<?= base_url('admin/data_user') ?>">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-text">Data User</span>
              </a>
            </li>
            <?php endif?>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                <i class="ni ni-button-power"></i>
                <span class="nav-link-text">Log Out</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>