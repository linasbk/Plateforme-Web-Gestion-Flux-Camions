<?php

require __DIR__ . '/../../src/bootstrap.php';

require_admin();
?>

<?php view('header', ['title' => "Reconnaissance de plaque", 'js' => 'vehicule']) ?>


<div class="main">

    <?php view('sidebar', ['titre' => "Reconnaissance de plaque d'immatriculation"]) ?>



    <form enctype="multipart/form-data" action="" method="post">
        <div>
            <label for="file">Choisir un fichier:</label>
            <input type="file" id="file" name="file" />
        </div>
        <div>
            <button type="submit">Envoyer</button>
        </div>
    </form>


    <?php view('footer') ?>