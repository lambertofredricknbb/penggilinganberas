<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('vendor/login/') ?>fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url('vendor/login/') ?>css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('vendor/login/') ?>css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url('vendor/login/') ?>css/style.css">

    <title>Sumber Rejeki Sejati</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="<?= base_url('assets/bg-login.png') ?>" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Log In <strong>Sumber Rejeki Sejati</strong></h3>
              <p class="mb-4">Silahkan Login ke Aplikasi Penggilingan<br> UD. SUMBER REJEKI SEJATI.</p>
            </div>
            <form action="<?= base_url('auth/proses_login')  ?>" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">
                
              </div>

              <input type="submit" value="Log In" class="btn text-white btn-block" style="background-color: #6c5ce7;">

            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="<?= base_url('vendor/login/') ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('vendor/login/') ?>js/popper.min.js"></script>
    <script src="<?= base_url('vendor/login/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('vendor/login/') ?>js/main.js"></script>
  </body>
</html>