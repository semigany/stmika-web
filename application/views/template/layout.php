<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Association des Anciens Saint Michel Amparibe</title>

  <!-- Favicons -->
  <link href="<?= base_url('assets') ?>/img/favicon.png" rel="icon" />
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet" />

  <!-- Bootstrap CSS File -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Libraries CSS Files -->
  <link href="<?= base_url('assets') ?>/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
  <link href="<?= base_url('assets') ?>/lib/animate/animate.min.css" rel="stylesheet" />
  <link href="<?= base_url('assets') ?>/lib/ionicons/css/ionicons.min.css" rel="stylesheet" />
  <link href="<?= base_url('assets') ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
  <!-- Main Stylesheet File -->
  <link href="<?= base_url('assets') ?>/css/style.css" rel="stylesheet" />

  <script src="<?= base_url('assets') ?>/lib/jquery/jquery.min.js"></script>
</head>

<body>
  <header id="header">
    <div class="container">
      <div class="logo float-left d-flex h-100">
        <a href="<?= base_url('home') ?>" class="justify-content-center align-self-center">
          <img src="<?= base_url('assets') ?>/img/logo ASM.png" class="img-logo" />
        </a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?= base_url('home') ?>">Accueil</a></li>
          <li class="active"><a href="<?= base_url('home/historique') ?>">Historique</a></li>

          <li><a href="<?= base_url('association') ?>">Association</a></li>
          <!-- <li><a href="https://semigany.com/" target="_blank">À l'international</a></li> -->
          <?php
          if (isset($_SESSION['id'])) {
          ?>
            <li><a class="btn btn-warning" href="<?= base_url('annuaire') ?>">Annuaire</a></li>
            <li class="drop-down">
              <a href="#"><?= $_SESSION['first_name'] ?></a>
              <ul>
                <li><a href="<?= base_url('user/logout') ?>">Déconnexion</a></li>
              </ul>
            </li>
          <?php
          } else {
          ?>
            <li><a href="<?= base_url('user/signInForm') ?>" class="btn btn-primary ml-1 mr-1 text-white">Se connecter</a></li>
            <li><a href="<?= base_url('user/registration') ?>" class="btn btn-warning ml-1 mr-1">S'inscrire</a></li>
          <?php
          }
          ?>

        </ul>
      </nav>
      <!-- .main-nav -->
    </div>
  </header>
  <div class="clearfix"></div>
  <main id="main" style="min-height:500px;"><?php $this->load->view($contents); ?></main>
  <div class="clearfix"></div>
  <footer id="footer" class="section-bg">
    <div class="footer-top">
      <div class="container">

        <div class="row">

          <div class="col-lg-6">

            <div class="row">

                <div class="col-sm-6">

                  <div class="footer-info">
                    <h4>Nous contacter</h4>
                    <p>
                       ASM Amparibe<br>
                      Antananarivo 101<br>
                      c/o Collège Saint Michel Amparibe <br>
                      BP 3832 Antananarivo 101 <br>
                      <strong>Téléphone:</strong> + 261 32 04 625 63<br>
                      <strong>Email:</strong> birao@semigany.org<br>
                    </p>

                  </div>
                  <div class="social-links">
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="https://web.facebook.com/AsmAmparibeMG" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                  </div>

                </div>

                <div class="col-sm-6">
                  <div class="footer-links">
                    <h4>Liens utiles</h4>
                    <ul>
                      <li><a href="<?= base_url('home') ?>">Accueil</a></li>
                      <li><a href="<?= base_url('actus') ?>">Actualités</a></li>
                      <li><a href="<?= base_url('events') ?>">Evènements</a></li>
                      <li><a href="<?= base_url('galery') ?>">Galerie</a></li>
                      <li><a href="<?= base_url('annuaire') ?>">Annuaire</a></li>
                    </ul>
                  </div>



                </div>

            </div>

          </div>

          <div class="col-lg-6">

            <div class="form">

              <h4>Envoyer nous un message</h4>
              <form action="<?= base_url('contact/send_email') ?>" method="post" role="form" class="contactForm">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nom" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet" required>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                </div>

                <div class="text-center"><button type="submit" title="Envoyer">Envoyer</button></div>
              </form>
            </div>

          </div>



        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        © Copyright <strong>ASM AMPARIBE</strong>. All Rights Reserved
      </div>
    </div>
  </footer>
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- JavaScript Libraries -->

  <script src="<?= base_url('assets') ?>/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?= base_url('assets') ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets') ?>/lib/easing/easing.min.js"></script>
  <script src="<?= base_url('assets') ?>/lib/mobile-nav/mobile-nav.js"></script>
  <script src="<?= base_url('assets') ?>/lib/wow/wow.min.js"></script>
  <script src="<?= base_url('assets') ?>/lib/waypoints/waypoints.min.js"></script>
  <script src="<?= base_url('assets') ?>/lib/counterup/counterup.min.js"></script>
  <script src="<?= base_url('assets') ?>/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets') ?>/lib/isotope/isotope.pkgd.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?= base_url('assets') ?>/js/main.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
</body>

</html>