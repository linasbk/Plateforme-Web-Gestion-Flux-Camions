<?php


require __DIR__ . '/../../src/bootstrap.php';
require __DIR__ . '/../../src/upload.php';

require_admin();
?>

<?php view('header', ['title' => "Reconnaissance de plaque", 'js' => 'vehicule']) ?>


<div class="main">

    <?php view('sidebar', ['titre' => "Reconnaissance de plaque d'immatriculation"]) ?>




    <form enctype="multipart/form-data" method="post">
        <div>
            <label class="recolabel" for="file">Choisir un fichier
                <input class="recofile" type="file" name="file" id="file">
            </label>
        </div>
        <div>
            <button type="submit" name="submit" id="submit">Envoyer</button>
        </div>

    </form>
    <p class="recotext">votre image: </p>
    <img src="/public/files/uploads/tocr.jpg" width="500" height="300" alt="aucune image" class="recoimage">
    <p class="recotext">votre resultat: </p>
    <?php echo tocr(); ?>

    <?php view('footer') ?>