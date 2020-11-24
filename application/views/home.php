<link href="<?= base_url('assets') ?>/css/home.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet"/>

<script>
  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 50) {
      $(".main-nav").addClass("color-on-scroll");
    } else {
      $(".main-nav").removeClass("color-on-scroll");
    }
  });
</script>

<section id="intro" class="clearfix">
  <div class="d-flex h-100">
    <div class="container first-content">
      <div class="justify-content-end">
        <div>
        <?php if (!isset($_SESSION['id'])) { ?>
        <h2>
          <span style="color: white;">Je m'inscris et j'accède à l'annuaire</span>
        </h2>
        <div>
          <a href="<?= base_url('user/registration') ?>" class="btn-get-started btn-primary">Créer mon compte en tant
            qu'Ancien</a>
          <a href="<?= base_url('user/signInForm') ?>" class="btn-get-started bg-warning">
            <i class="fa fa-play"></i>
            Déjà membre
          </a>
        </div>
        <?php }  else { ?>
          <form id="search-form" action="<?= base_url('annuaire/index') ?>" method="GET">
            <div class="input-group justify-content-center">
              <input type="search" name="search" class="simple-search" placeholder="Rechercher*"/>
              <span class="input-group-append">
                <div class="input-group-text bg-transparent" onclick="search()">
                  <i class="fa fa-search"></i>
                </div>
              </span>
            </div>
          </form>
          <p class="hint lead">* Saisissez ici pour rechercher par nom ou prénom</p>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="faq" class="section-bg pt-4 pb-4">
  <header class="section-header pt-4 pb-4">
    <h3>Evènements</h3>
  </header>
  <div class="container">

    <ul id="faq-list" class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
      <?php foreach ($events as $event) { ?>
      <li>
        <a data-toggle="collapse" class="collapsed" href="#<?= 'faq' . $event->id ?>"
          aria-expanded="false"><?= $event->title . ' - ' . date_format(date_create($event->start_at),"d/m/Y") ?><i
            class="ion-android-remove"></i></a>
        <div id="<?= 'faq' . $event->id ?>" class="collapse row" data-parent="#faq-list">
          <div class="col-md-4 col-sm-12" style="height: 200px;">

            <img src="<?= base_url('uploads/events') .'/'.$event->photo?>"
              style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div class="col-md-8 col-sm-12">
            <p>
              <?= $event->description ?>
            </p>
          </div>

        </div>
      </li>

      <?php } ?>
    </ul>

    <div class="clearfix mt-2"></div>
    <div class="row mt-4">
      <div class="col text-center">
        <a href="<?= base_url('events') ?>" class="btn btn-warning">Voir plus</a>
      </div>
    </div>
  </div>
</section>

<section class="clearfix pt-4 pb-4">
  <header class="section-header pt-4 pb-4">
    <h3>Les dernières nouvelles</h3>
  </header>
  <div class="container">
    <div class="row">
      <?php foreach ($actus as $actu) { ?>
        <div class="col-md-4 col-xs-12 mb-4">
          <div class="actus-img-container">
            <img src="<?= base_url('uploads/actus') .'/'.$actu->photo?>" class="card-img-top" alt="...">
          </div>
          <div class="card-body">
              <h5 class="card-title"><?= $actu->title ?></h5>
              <p class="crop-text-5 mb-3"><small><?= strip_tags($actu->description) ?></small></p>
              <small class="d-block text-muted mb-3"><?= strip_tags(date_format(date_create($actu->date),"d/m/Y")) ?></small>
              
              <small><a href="<?= base_url('actus/detail').'/'.$actu->id ?>" class="text-warning">Lire la suite</a></small>
          </div>
          
      </div>

      <?php } ?>
    </div>
    <div class="clearfix mt-2"></div>
    <div class="row mt-4">
      <div class="col text-center">
        <a href="<?= base_url('actus') ?>" class="btn btn-warning">Voir plus</a>
      </div>
    </div>
  </div>
</section>


<section id="portfolio" class="section-bg pt-4 pb-4">
  <div class="container">

    <header class="section-header pt-4 pb-4">
      <h3 class="section-title">Quelques photos de nous</h3>
    </header>

    <div class="row">
      <?php foreach($photos as $photo) { ?>
        <a href="<?= base_url('uploads/galerie') .'/'. $photo->url ?>" data-toggle="lightbox" data-gallery="gallery" class="col-md-3 mb-4">
          <img src="<?= base_url('uploads/galerie') .'/thumb__'. $photo->url ?>" class="img-fluid rounded" style="width:100%; height: auto; object-fit: cover;">
        </a>
      <?php } ?>
    </div>
    <div class="row mt-4">
      <div class="col text-center">
        <a href="<?= base_url('galery') ?>" class="btn btn-warning">Voir plus</a>
      </div>
    </div>

  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    function search() {
      document.getElementById("search-form").submit();
    }
</script>

