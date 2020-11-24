<link href="<?= base_url('assets') ?>/css/user.css" rel="stylesheet" />

<div class="clearfix"></div>
<section class="detail-content section-bg">
  <div class="container">
    <div class="section-header">
      <h1 class="detail-main-title">Annuaire</h1>
    </div>
  
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-8 col-sm-12 user-detail">
        <div class="person-item">
          <div class="row pt-2 mb-4">
            <div class="user-photo col-md-4 col-sm-12">
              <?php 
              $photo = base_url('uploads/pdp'). '/'.$user->photo;
              if (empty($user->photo)) {
                $photo = "https://ui-avatars.com/api/?name=". $user->first_name . ' ' . $user->last_name ."&background=F5F8FD&color=E0A800&rounded=true";
              }?>
              <img src="<?= $photo ?>" alt="<?= $user->first_name . ' ' . $user->last_name ?>">
            </div>
            <div class="col-md-8 col-sm-12 my-auto">
              <h2 class="person-name">
                <?= $user->first_name .' '.$user->last_name ?>
              </h2>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>

        <dl class="row">
          <dt class="col-sm-4">Promotion</dt>
          <dd class="col-sm-8"><?= $user->promotion . ' - '. $user->release_year ?></dd>
          <?php
            if ($user->end_year == null||$user->end_year == 0) {
              echo '<dt class="col-sm-12">Année '. $user->start_year .'</dt>';
            } else {
              echo '<dt class="col-sm-12">Année ' . $user->start_year . ' à ' . $user->end_year .'</dt>';
            }
          ?>

        </dl>
        <h5>Coordonnées</h5>
        <dl class="row">

          <dt class="col-sm-4">Email</dt>
          <dd class="col-sm-8"><?= $user->email ?></dd>
          <dt class="col-sm-4">Téléphone</dt>
          <dd class="col-sm-8"><?= $user->phone_number ?></dd>
          <dt class="col-sm-4">Adresse</dt>
          <dd class="col-sm-8"><?= $user->adress ?></dd>
        </dl>
        <h3 class="">Situation actuelle</h3>
        <?php if (!$user->student&&!$user->employee) {
				?>
        <p>Aucune information</p>
        <?php } ?>

        <?php if ($user->student) {
				?>
        <h5>Etude</h5>
        <dl class="row">
          <dt class="col-sm-4">Ecole</dt>
          <dd class="col-sm-8"><?= $user->school_name ?></dd>

          <dt class="col-sm-4">Filière</dt>
          <dd class="col-sm-8"><?= $faculty->title ?></dd>

          <dt class="col-sm-4">Niveau</dt>
          <dd class="col-sm-8"><?= $user->level ?></dd>

        </dl>
        <?php
				}
				?>

        <?php if ($user->employee) {
				?>
        <h5>Profession</h5>
        <dl class="row">
          <dt class="col-sm-4">Intitulé du poste</dt>
          <dd class="col-sm-8"><?= $user->job_title ?></dd>

          <dt class="col-sm-4">Secteur d'activité</dt>
          <dd class="col-sm-8"><?= $domain->title ?></dd>

          <dt class="col-sm-4">Organisation</dt>
          <dd class="col-sm-8"><?= $user->organization_name ?></dd>

          <dt class="col-sm-4">Adresse</dt>
          <dd class="col-sm-8"><?= $user->organization_adress ?></dd>
        </dl>
        <?php
				}
				?>
      </div>

      <div class="col-md-4 col-sm-12 similars">
        <h4>Dans la même promotion</h4>
        <div class="related-users">
          <?php
            foreach($users_in_promotion as $u) {
          ?>
            <a href="<?= base_url('user/details/') . $u->id ?>">
              <div class="row mb-2 related-user-item d-flex align-items-center">
                <div class="col-2 img">
                  <?php 
                    $photo = base_url('uploads/pdp'). '/'.$u->photo;
                    if (empty($u->photo)) {
                      $photo = "https://ui-avatars.com/api/?name=". $u->first_name . ' ' . $u->last_name ."&background=F5F8FD&color=E0A800&rounded=true";
                    }?>
                  <img src="<?= $photo ?>" alt="<?= $u->first_name . ' ' . $u->last_name ?>" width="40" height="40"/>
                </div>
                <div class="col-10">
                  <span class="person-name">
                    <?= $u->first_name .' '.$u->last_name ?>
                  </span>
                </div>
              </div>
            </a>
          <?php
            }
          ?>
        </div>

      </div>
    </div>

  </div>

</section>