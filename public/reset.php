<?php
require __DIR__ . '/../src/bootstrap.php';
?>

<?php view('header', ['title' => 'Réinitialiser votre mot de passe', 'css' => 'register']) ?>


<div class="indexbody">

    <div class="login-wrapper">
        <div action="" class="form-contenue register">
            <h1 style="text-align:center;">Réinitialiser votre mot de passe</h1>
            <div class="card-body" id="formContainer">

                <div class="Form" id="loginForm">

                    <form action="#" method="post">


                        <div class="input-group">
                            <input type="password" name="currentpassword" id="currentpassword" value="<?= $inputs['password'] ?? '' ?>" class="<?= error_class($errors, 'password') ?>" required>
                            <label for="password">Mot de passe actuelle</label>
                            <small><?= $errors['password'] ?? '' ?></small>
                        </div>


                        <div class="input-group">
                            <input type="password" name="password" id="password" value="<?= $inputs['password'] ?? '' ?>" class="<?= error_class($errors, 'password') ?>" required>
                            <label for="password">Mot de passe</label>
                            <small><?= $errors['password'] ?? '' ?></small>
                        </div>

                        <div class="input-group">
                            <input type="password" name="password2" id="password2" value="<?= $inputs['password2'] ?? '' ?>" class="<?= error_class($errors, 'password2') ?>" required>
                            <label for="password2">Confirmez le mot de passe</label>
                            <small><?= $errors['password2'] ?? '' ?></small>
                        </div>


                        <button type="submit" class="submit-btn">Réinitialiser</button>

                        <footer class="insfooter">Déjà membre? <a href="login.php">Se connecter</a></footer>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<?php view('footer') ?>