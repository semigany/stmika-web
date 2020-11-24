<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="<?= base_url('assets/bo') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/bo') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block" style="background-image: url(<?= base_url('assets/img/logo.jpg') ?>); background-position: center;
    background-size: cover;"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Authentification</h1>
                  </div>
                  <form action="<?= base_url('admin/signIn') ?>" method="POST" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Nom d'utilisateur">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Mot de passe">
                    </div>

                    <button type="submit" class="btn btn-primary  btn-user btn-block">Connecter</button>
</form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</body>
</html>

