<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/resetpass.php';
?>

<?php view('header', ['title' => "Réinitialiser votre mot de passe", 'css' => 'register']) ?>

<div class="indexbody">

    <div class="login-wrapper">
        <div action="" class="form-contenue">
            <h1 style="text-align:center;">Réinitialiser votre mot de passe</h1>
            <div class="card-body" id="formContainer">
                <div class="Form" id="loginForm">

                    <form action="forgot-password.php" method="post">

                        <div class="input-group">
                            <input type="email" name="email" id="email" value="<?= $inputs['email'] ?? '' ?>" required>
                            <label for="email">E-mail</label>
                            <small><?= $errors['email'] ?? '' ?></small>
                        </div>

                        <section>
                            <button name="submit" type="submit" class="submit-btn">Envoyer</button>
                            <footer class="insfooter">Déjà membre? <a href="login.php">Se connecter</a></footer>
                        </section>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php view('footer') ?>