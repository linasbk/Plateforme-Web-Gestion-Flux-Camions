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
            <label for="file">Choisir un fichier:</label>
            <input type="file" name="file" id="file">
        </div>
        <div>
            <button type="submit" name="submit" id="submit">Envoyer</button>
        </div>

    </form>
    <p>votre image: </p>
    <img src="/public/files/uploads/tocr.jpg" alt="aucune image" style="height: 100%;width: 50%;">
    <p>votre resultat: </p>
    <?php echo tocr(); ?>

    <?php view('footer') ?>