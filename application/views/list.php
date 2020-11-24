<link href="<?= base_url('assets') ?>/css/annuaire.css" rel="stylesheet" />
<section class="clearfix" id="annuaire">
  

  <div class="container">
  <header class="section-header mb-5">
            <h2 class="display-4">Annuaire</h2>
  </header>
    <div class="row">
      <div class="col-md-4">
        <h3>Recherche</h3>
        <form action="<?= base_url('annuaire/index') ?>" method="GET">
          <div class="form-group">
            <label for="search">Nom ou prénom de la personne</label>
            <input type="text" class="form-control" name="search" id="search" placeholder="Recherche..." value="<?= $search ?>">
          </div>
          <div class="form-group">
            <label for="promotion">Promotion</label>
            <div class="form-control p-0">
              <select name="promotion_id" id="promotion" placeholder="promotion" class="selectpicker" data-live-search="true" data-style="btn-white" data-width="100%" data-size="10">
                <option value="0">--</option>
                <?php foreach ($promotions as $prom) {
                  $selected = '';
                  if ($prom->id == $promotion_id) {
                    $selected = 'selected';
                  }
                ?>
                  <option value="<?= $prom->id ?>" <?= $selected ?>><?= $prom->name ?> (<?= $prom->release_year ?>)</option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="col">
              <input type="number" class="form-control" id="start_year" name="start_year" placeholder="Année d'entrée" value="<?= $start_year ?>">
            </div>
            <div class="col">
              <input type="number" class="form-control" name="end_year" id="end_year" placeholder="Année de sortie" value="<?= $end_year ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="faculty_id">Filière</label>
            <div class="form-control p-0">
            <select name="faculty_id" id="faculty_id" class="selectpicker" data-live-search="true" data-style="btn-white" data-width="100%">
              <option value="0">--</option>
              <?php foreach ($faculties as $faculty) {
                $selected = '';
                if ($faculty->id == $faculty_id) {
                  $selected = 'selected';
                }
              ?>
                <option value="<?= $faculty->id ?>" <?= $selected ?>><?= $faculty->title ?></option>
              <?php } ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label for="domain_id">Domaine d'activité (profession)</label>
            <div class="form-control p-0">
            <select name="domain_id" id="domain_id" class="selectpicker" data-live-search="true" data-style="btn-white" data-width="100%">
              <option value="0">--</option>
              <?php foreach ($domains as $domain) {
                $selected = '';
                if ($domain->id == $domain_id) {
                  $selected = 'selected';
                }
              ?>
                <option value="<?= $domain->id ?>" <?= $selected ?>><?= $domain->title ?></option>
              <?php } ?>
            </select>
            </div>
          </div>
          <input type="submit" class="btn btn-primary float-right" value="Rechercher" />
        </form>
        <div class="clearfix"></div>
      </div>

      <div class="col-md-8">
        <div class="row ml-3">
          <?php
          if (empty($users)) {
          ?>
            <div class="d-block alert alert-secondary" role="alert">
              Aucun résultat trouvé
            </div>
            <?php
          } else {
            foreach ($users as $user) {
            ?>
              <div class="person-item col-md-6 col-lg-6 col-sm-12">
                  <div class="row d-flex align-items-center">
                    <div class="col-2">
                      <?php 
                      $photo = base_url('uploads/pdp'). '/'.$user->photo;
                      if (empty($user->photo)) {
                        $photo = "https://ui-avatars.com/api/?name=". $user->first_name . ' ' . $user->last_name ."&background=F5F8FD&color=E0A800&rounded=true";
                      }?>
                      <img src="<?= $photo ?>" alt="<?= $user->first_name . ' ' . $user->last_name ?>">
                    </div>
                    <div class="col-10 my-auto">
                      <span class="person-name">
                      <strong><a class="link-to-user" href="<?= base_url('user/details/') . $user->id ?>"><?= $user->first_name . ' ' . $user->last_name ?></a></strong>
                      </span>
                      <small><?= $user->promotion ?></small>
                    </div>
                  </div>
              </div>

          <?php
            }
          }
          ?>
        </div>
        <div class="row ml-3">
          <div class="col">
            <?php
            echo $this->pagination->create_links();
            ?>
          </div>

        </div>
      </div>

    </div>



  </div>
</section>