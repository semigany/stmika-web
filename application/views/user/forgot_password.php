<link href="<?= base_url('assets') ?>/css/sign-in.css" rel="stylesheet" />

<section class="clearfix" style="margin-top: 50px;">
    <div class="container">
        <h3 class="text-center">Mot de passe oublié</h3>
        <form action="<?= base_url('user/send_forgot_password_request') ?>" method="post" class="form-signin">
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
            <label for="email">Veuillez nous renseigner votre adresse email sur le site www.semigany.org. 
            Nous vous enverrons un lien de réinitialisation de votre mot de passe. </label>
            <input type="email" id="email" name="emailAddress" class="form-control"
                placeholder="Adresse email"required>

            <div class="clearfix mb-4"></div>
            
            <button class="btn btn-primary btn-block btn-connect" type="submit">Envoyer</button>
        </form>
    </div>
</section>