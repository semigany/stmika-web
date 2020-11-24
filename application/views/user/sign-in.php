<link href="<?= base_url('assets') ?>/css/sign-in.css" rel="stylesheet" />

<section class="clearfix" style="margin-top: 50px;">
    <div class="container text-center">
        <form action="<?= base_url('user/signIn') ?>" method="post" class="form-signin">
            <h2 class="display-6">Connexion</h2>
            <p>Accéder à l'annuaire</p>
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
            <label for="inputEmail" class="sr-only">Adresse email</label>
            <input type="email" id="inputEmail" name="emailAddress" class="form-control"
                placeholder="Adresse email" autofocus="" required>
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control"
                placeholder="Mot de passe" required>

            <div class="clearfix mb-4"></div>

            <button class="btn btn-primary btn-block btn-connect" type="submit">Se connecter</button>
        </form>

        <a href="<?= base_url('user/forgot_password') ?>" class="mt-5">Mot de passe oublié ?</a>
    </div>
</section>