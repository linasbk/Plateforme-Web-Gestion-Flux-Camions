<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/login.php';

?>

<?php view('header', ['title' => "Se connecter", 'css' => 'register']) ?>

<div class="indexbody">

    <div class="login-wrapper">
        <div action="" class="form-contenue">
            <h1 style="text-align:center;">Se connecter</h1>
            <div class="card-body" id="formContainer">
                <div class="Form" id="loginForm">

                    <form action="login.php" method="post">

                        <div class="input-group">
                            <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>" required>
                            <label for="username">Nom d'utilisateur</label>
                            <small><?= $errors['username'] ?? '' ?></small>
                        </div>

                        <div class="input-group">
                            <input type="password" name="password" id="password" required>
                            <label for="password">Mot de passe</label>
                            <small><?= $errors['password'] ?? '' ?></small>

                            <?php if (isset($errors['login'])) : ?>
                                <small>
                                    <?= $errors['login'] ?>
                                    <a class="forgot-password" href="forgot-password.php"> Mot de passe oublié?</a>
                                </small>
                            <?php endif ?>

                            <small><?= $errors['approved'] ?? '' ?></small>

                        </div>

                        <div style="display: flex;">
                            <label for="remember_me">
                                <input type="checkbox" name="remember_me" id="remember_me" value="checked" <?= $inputs['remember_me'] ?? '' ?> />
                                Se souvenir de moi
                            </label>
                            <small><?= $errors['agree'] ?? '' ?></small>
                        </div>

                        <section>
                            <button type="submit" class="submit-btn">Se connecter</button>
                            <footer class="insfooter">Pas un membre! <a href="register.php">Inscription</a></footer>
                        </section>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php view('footer') ?>