<style>
    .user-photo {
        width: 150px;
        height: 150px;
    }
    .user-photo img {
        background: #eeeeee;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Détails</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="container">
                <div class="row mb-5">
                    <div class="person-item col">
                        <div class="row">
                            <div class="col-md-3 col-sm-12 user-photo">
                                <?php
                    $photo = base_url('uploads/pdp'). '/'.$registration->photo;
                    if (empty($registration->photo)) {
                      $photo = "https://ui-avatars.com/api/?name=". $registration->first_name . ' ' . $registration->last_name ."&background=F5F8FD&color=E0A800&rounded=true";
                    }?>
                                 <img src="<?= $photo ?>" alt="<?= $registration->first_name . ' ' . $registration->last_name ?>" class="rounded-circle">

                            </div>
                            <div class="col-md-9 col-sm-12">
                                <h2 class="person-name">
                                    <?= $registration->first_name .' '.$registration->last_name ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col">
                        <dl class="row">
                            <dt class="col-sm-3">Promotion</dt>
                            <dd class="col-sm-9"><?= $registration->promotion . ' - '. $registration->release_year ?>
                            </dd>
                            <dt class="col-sm-12">De <?= $registration->start_year . ' à ' . $registration->end_year ?>
                            </dt>

                        </dl>
                        <h5>Coordonnées</h5>
                        <dl class="row">

                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9"><?= $registration->email ?></dd>
                            <dt class="col-sm-3">Téléphone</dt>
                            <dd class="col-sm-9"><?= $registration->phone_number ?></dd>
                            <dt class="col-sm-3">Adresse</dt>
                            <dd class="col-sm-9"><?= $registration->adress ?></dd>
                        </dl>
                        <h3>Situation actuelle</h3>
                        <?php if ($registration->student) {
				?>
                        <h5>Etude</h5>
                        <dl class="row">
                            <dt class="col-sm-3">Ecole</dt>
                            <dd class="col-sm-9"><?= $registration->school_name ?></dd>

                            <dt class="col-sm-3">Filière</dt>
                            <dd class="col-sm-9"><?= $faculty->title ?></dd>

                            <dt class="col-sm-3">Specialité</dt>
                            <dd class="col-sm-9"><?= $registration->specialty ?></dd>

                            <dt class="col-sm-3">Niveau</dt>
                            <dd class="col-sm-9"><?= $registration->level ?></dd>

                        </dl>
                        <?php
				}
				?>

                        <?php if ($registration->employee) {
				?>
                        <h5>Profession</h5>
                        <dl class="row">
                            <dt class="col-sm-3">Intitulé du poste</dt>
                            <dd class="col-sm-9"><?= $registration->job_title ?></dd>

                            <dt class="col-sm-3">Secteur d'activité</dt>
                            <dd class="col-sm-9"><?= $domain->title ?></dd>

                            <dt class="col-sm-3">Organisation</dt>
                            <dd class="col-sm-9"><?= $registration->organization_name ?></dd>

                            <dt class="col-sm-3">Adresse</dt>
                            <dd class="col-sm-9"><?= $registration->organization_adress ?></dd>
                        </dl>
                        <?php
				}
				?>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#test">Refuser
                l'inscription</button>
            <form action="<?= base_url('user/accept_registration/') . $registration->id ?>" method="POST">
                <button type="submit" class="btn btn-success">Valider l'inscription</button>
            </form>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="test" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refuser cette inscription</h5>
                <button type="button" class="close close-cancel-modal" id="" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/reject_registration/') . $registration->id ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message *:</label>
                        <textarea class="form-control" id="message-text" name="message" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-cancel-modal">Fermer</button>
                    <button type="submit" class="btn btn-danger">Confirmer le refus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.close-cancel-modal').click(function () {
        $('#test').modal('hide')
    });
</script>