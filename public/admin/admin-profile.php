<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Admin', 'js' => 'vehicule']) ?>


<div class="main">
    <?php view('sidebar') ?>

    <titre>
        <strong>Admin </strong> Profile
    </titre>

    <form action="" method="post" enctype="multipart/form-data">

        <div>
            <label for="text-input">Nom de l'administrateur</label>
            <input id="fullname" name="fullname" type="text" value="<?php echo $admin['fullname']; ?>">
        </div>

        <div>
            <label for="text-input">Nom d'utilisateur</label>
            <input id="username" name="username" type="text" value="<?php echo $admin['UserName']; ?>">
        </div>


        <div>
            <label for="email-input">E-mail</label>
            <input id="email" name="email" type="email" value="<?php echo $admin['Email']; ?>" required="true">
        </div>


        <p class="centerbutton"><button type="submit" name="submit">Mise à jour</button></p>

    </form>
    <a href="change-password.php"><button><i></i>Modifier mot de passe</button></a>
</div>


<?php view('footer') ?>