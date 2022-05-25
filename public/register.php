<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/register.php';
?>

<?php view('header', ['title' => 'Inscription', 'css' => 'register']) ?>


<body class="indexbody">

    <div class="login-wrapper">
        <div action="" class="form-contenue register">
            <h1 style="text-align:center;">Inscription</h1>
            <div class="card-body" id="formContainer">

                <div class="Form" id="loginForm">

                    <form action="register.php" method="post">


                        <div class="input-group">
                            <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>" class="<?= error_class($errors, 'username') ?>" required>
                            <label for="username">Nom d'utilisateur</label>
                            <small><?= $errors['username'] ?? '' ?></small>
                        </div>

                        <div class="input-group">
                            <input type="email" name="email" id="email" value="<?= $inputs['email'] ?? '' ?>" class="<?= error_class($errors, 'email') ?>" required>
                            <label for="email">Email</label>
                            <small><?= $errors['email'] ?? '' ?></small>
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


                        <button type="submit" class="submit-btn">Inscription</button>

                        <footer class="insfooter">Déjà membre? <a href="login.php">Se connecter</a></footer>

                    </form>

                </div>
            </div>

        </div>

        <?php view('footer') ?>