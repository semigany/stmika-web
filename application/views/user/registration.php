<style>
  .imagePreview {
    width: 100%;
    height: 180px;
    background-position: center center;
    background: url(<?= base_url('assets/img/no-image.png')?>);
    background-color: #fff;
    background-size: cover;
    background-repeat: no-repeat;
    display: inline-block;
    box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
    text-align: center;
    vertical-align: middle;
  }

  .btn-upload {
    display: block;
    border-radius: 0px;
    box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
    margin-top: -5px;
  }

  .imgUp {
    margin-bottom: 15px;
  }

  .del {
    position: absolute;
    top: 0px;
    right: 15px;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    background-color: rgba(255, 255, 255, 0.6);
    cursor: pointer;
  }

  .imgAdd {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #4bd7ef;
    color: #fff;
    box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
    text-align: center;
    line-height: 30px;
    margin-top: 0px;
    cursor: pointer;
    font-: 15px;
  }
</style>

<section id="registration" class="clearfix section-bg pt-4 pb-4" style="margin-top: 80px;">
  <div class="container">

    <header class="section-header">
      <h3 class="section-title">Inscription</h3>
    </header>

    <p>
      <span class="font-weight-bold">NB:</span> </br><span class="text-muted">
        Entrez les informations obligatoires demandées. Veuillez fournir des données exactes.</br>
        Après la submission, les administrateurs vérifieront votre identité et vous enverront un lien vers l'adresse
        email que vous avez entré pour activer votre compte.
      </span>
    </p>
    <?php if (validation_errors()) { ?>
    <div class="alert alert-danger form-error-container" role="alert">
      <?php echo validation_errors(); ?>
    </div>
    <?php } ?>
    <?php if (isset($upload_errors)) { ?>
    <div class="alert alert-danger form-error-container" role="alert">
      <?php echo $upload_errors; ?>
    </div>
    <?php } ?>

      <h3>Veuillez sélectionner une photo de vous </h3>

    <form action="<?= base_url('user/submitRegistration') ?>" method="post" enctype="multipart/form-data">
      <h5>Informations personnelles</h5>
      <div class="row">
        <div class="col-sm-3 imgUp">
          <span>Ajouter une photo (30Mo max)</span>
          <div class="imagePreview mt-2"></div>
          <label class="btn btn-primary btn-upload">
            Choisir<input type="file" id="photo" class="uploadFile img" value="Upload Photo" name="photo"
              style="width: 0px;height: 0px;overflow: hidden;">
          </label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12">
          <div class="form-group">
            <label for="last_name">Nom *</label>
            <input type="text" class="form-control" id="last_name" name="last_name"
              value="<?php echo set_value('last_name'); ?>"  required>
          </div>
        </div>

        <div class="col-md-4 col-lg-4 col-sm-12">

          <div class="form-group">
            <label for="first_name">Prénom(s) *</label>
            <input type="text" class="form-control" id="first_name" name="first_name"
              value="<?php echo set_value('first_name'); ?>"  required>
          </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12">

          <div class="form-group mb-4">
            <label for="birth_date">Date de naissance</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date"
              value="<?php echo set_value('birth_date'); ?>" >
          </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12">

          <div class="form-group">
            <label for="email">Email*</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>"
               required>
          </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12">

          <div class="form-group">
            <label for="phone_number">Téléphone</label>
            <input type="text" class="form-control" id="phone_number" value="<?php echo set_value('phone_number'); ?>"
               name="phone_number">
          </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12">

          <div class="form-group">
            <label for="adress">Ville*</label>
            <input type="text" class="form-control" id="adress" value="<?php echo set_value('adress'); ?>"
              name="adress" required>
          </div>

        </div>
      </div>
      <hr>
      <h5>Période</h5>
      <div class="row">


        <div class="col-md-3 col-lg-3 col-sm-12">


          <label for="start_year">Année d'entrée*</label>
          <input type="number" min="1950" max="2020" class="form-control" id="start_year" name="start_year"
            value="<?php echo set_value('start_year'); ?>" maxlength="4" required>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12">
          <label for="end_year">Année de sortie</label>
          <input type="number" min="1950" max="2020" class="form-control" id="end_year" name="end_year"
            value="<?php echo set_value('end_year'); ?>" maxlength="4">

        </div>
        <div class="col-md-4 col-lg-4 col-sm-12">
          <div class="form-group">
            <label for="promotion_id">Promotion(Terminale)</label>
            <div class="form-control p-0">
              <select name="promotion_id" id="promotion_id" data-size="10" class="selectpicker" data-live-search="true"
                data-style="btn-white" data-width="100%" size="3">
                <option value="0">--</option>
                <?php foreach ($promotions as $prom) { ?>
                <option value="<?= $prom->id ?>"
                  <?= $this->input->post('promotion_id') == $prom->id ? 'selected' : '' ?>><?= $prom->name ?> (<?= $prom->release_year ?>) </option>
                <?php } ?>

              </select>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <h5>Situation actuelle</h5>

      <div class="row">
        <div class="col-md-6">
          <div class="custom-control custom-switch mb-3">
            <input type="checkbox" class="custom-control-input" id="student" name="student" onchange="schoolChange();"
              <?= empty($this->input->post('student')) ? '' : 'checked' ?>>
            <label class="custom-control-label" for="student">Etudiant</label>
          </div>


          <div id="student-info" style="display: none;">
            <div class="form-group">
              <label for="school_name">Ecole</label>
              <input type="text" class="form-control" id="school_name" name="school_name"
                value="<?php echo set_value('school_name'); ?>">
            </div>

            <div class="form-group">
              <label for="faculty">Filière*</label>
              <div class="form-control p-0">
                <select id="faculty" name="faculty_id" class="selectpicker" data-live-search="true"
                  data-style="btn-white" data-width="100%" data-size="10">
                  <option value="0">--</option>
                  <?php foreach ($faculties as $faculty) { ?>
                  <option value="<?= $faculty->id ?>"
                    <?= $this->input->post('faculty_id') == $faculty->id ? 'selected' : '' ?>><?= $faculty->title ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="level">Niveau</label>
              <input type="text" class="form-control" id="level" name="level" value="<?php echo set_value('level'); ?>">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="custom-control custom-switch mb-3">
            <input type="checkbox" class="custom-control-input" id="employee" name="employee" onchange="jobChange();"
              <?= empty($this->input->post('employee')) ? '' : 'checked' ?>>
            <label class="custom-control-label" for="employee">Travailleur</label>
          </div>


          <div id="organization-info" style="display: none;">
            <div class="form-group">
              <label for="job_title">Profession</label>
              <input type="text" class="form-control" id="job_title" name="job_title"
                value="<?php echo set_value('job_title'); ?>">
            </div>
            <div class="form-group">
              <label for="domain">Secteur/Domaine d'activité*</label>
              <div class="form-control p-0">
                <select id="domain" name="domain_id" class="selectpicker" data-live-search="true" data-style="btn-white"
                  data-width="100%" data-size="10">
                  <option value="0">--</option>
                  <?php foreach ($domains as $domain) { ?>
                  <option value="<?= $domain->id ?>"
                    <?= $this->input->post('domain_id') == $domain->id ? 'selected' : '' ?>><?= $domain->title ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="organization_name">Organisation</label>
              <input type="text" class="form-control" id="organization_name" name="organization_name"
                placeholder="Entreprise, société, ..." value="<?php echo set_value('organization_name'); ?>">
            </div>

            <div class="form-group">
              <label for="organization_adress">Ville</label>
              <input type="text" class="form-control" id="organization_adress" name="organization_adress"
                value="<?php echo set_value('organization_adress'); ?>">
            </div>
          </div>
        </div>
      </div>

      <hr>
      <h5>Accès</h5>
      <div class="form-group row">
        <label for="password" class="col-sm-4 col-form-label">Mot de passe*</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
        </div>
      </div>

      <div class="form-group row">
        <label for="cpassword" class="col-sm-4 col-form-label">Confirmation du mot de passe*</label>
        <div class="col-sm-4">
          <input type="password" name="passwordconf" class="form-control" id="passwordconf"
            placeholder="Confirmation du mot de passe">
        </div>
      </div>
      <hr>

      <input type="checkbox" id="check-cgu" name="check-cgu" required/>
      <label for="check-cgu">J'ai lu et j'accèpte les <button class="btn btn-link" data-toggle="modal" data-target="#cgu-modal">Conditions Générales d'Utilisation</button></label>

      <hr>

      <input type="submit" id="submit-form" class="btn btn-success" value="Valider et envoyer" />
    </form>

  </div>

  <div class="modal fade cgu-modal" id="cgu-modal" tabindex="-1" role="dialog" aria-labelledby="cguModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cguModalLabel">Conditions Générales d'Utilisation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php $this->load->view($cgu); ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  jobChange();
  schoolChange();

  function jobChange() {
    const inputs = ['organization']
    if ($('#employee').is(":checked")) {
      $('#organization-info').show()
      for (let i = 0; i < inputs.length; i++) {
        $('#' + inputs[i]).attr('required', true)
      }
    } else {
      $('#organization-info').hide()
      for (let i = 0; i < inputs.length; i++) {
        $('#' + inputs[i]).attr('required', false)
      }
    }
  }

  function schoolChange() {
    const inputs = ['faculty']
    if ($('#student').is(":checked")) {
      $('#student-info').show()
      for (let i = 0; i < inputs.length; i++) {
        $('#' + inputs[i]).attr('required', true)
      }
    } else {
      $('#student-info').hide()
      for (let i = 0; i < inputs.length; i++) {
        $('#' + inputs[i]).attr('required', false)
      }
    }
  }

  $(".imgAdd").click(function () {
    $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
  });
  $(document).on("click", "i.del", function () {
    $(this).parent().remove();
  });
  $(function () {
    $(document).on("change", ".uploadFile", function () {
      var uploadFile = $(this);
      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

      if (/^image/.test(files[0].type)) { // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function () { // set image data as background of div
          //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
          uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
        }
      }

    });
  });

  document.getElementById("photo").onchange = function () {
    $("#form-photo").submit();
  };
</script>