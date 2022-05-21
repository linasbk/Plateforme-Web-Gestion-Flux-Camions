<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/login.php';
?>

<?php view('header', ['title' => "Se connecter", 'css' => 'auth']) ?>

<?php if (isset($errors['login'])) : ?>
    <div class="alert alert-error">
        <?= $errors['login'] ?>
    </div>
<?php endif ?>

<form action="login.php" method="post">
    <h1>Se connecter</h1>
    <div>
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>">
        <small><?= $errors['username'] ?? '' ?></small>
    </div>

    <div>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password">
        <small><?= $errors['password'] ?? '' ?></small>
    </div>

    <div>
        <label for="remember_me">
            <input type="checkbox" name="remember_me" id="remember_me" value="checked" <?= $inputs['remember_me'] ?? '' ?> />
            Se souvenir de moi
        </label>
        <small><?= $errors['agree'] ?? '' ?></small>
    </div>
    <section>
        <button type="submit">Se connecter</button>
        <a href="register.php">Inscription</a>
    </section>
    <small><?= $errors['approved'] ?? '' ?></small>
</form>

<?php view('footer') ?>