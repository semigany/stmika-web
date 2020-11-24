<link href="<?= base_url('assets') ?>/css/sign-in.css" rel="stylesheet" />

<section class="clearfix" style="margin-top: 50px;">
    <div class="container">
        <form action="<?= base_url('user/reset_password') . '?t=' . $token ?>" method="post" class="form-signin">
            <h3 class="text-center">Réinitialisation de mot de passe</h3>
            <div class="alert alert-secondary">
                Bonjour <b><?= $user->last_name ?></b>. Vous avez demandé une réinitialisation de mot de passe. 
                Veuillez entrer votre nouveau mot de passe.
            </div>
            <?php if (validation_errors()) {?>
            <div class="alert alert-danger form-error-container" role="alert">
                <?php echo validation_errors(); ?>
            </div>
            <?php } ?>
            <?php if (isset($message)) {?>
                <div class="alert alert-danger form-error-container" role="alert">
                    <?php echo $message->getMessage(); ?>
                </div>
                <?php } ?>
            
            <div class="form-group">
                <label for="password">Nouveau mot de passe*</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            </div>

            <div class="form-group">
                <label for="cpassword" >Confirmation du mot de passe*</label>

                <input type="password" name="passwordconf" class="form-control" id="passwordconf"
                    placeholder="Confirmation du mot de passe">
            </div>

            <button class="btn btn-connect btn-primary btn-block" type="submit">Confirmer</button>
        </form>
    </div>
</section>