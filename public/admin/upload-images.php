<?php

require __DIR__ . '/../../src/bootstrap.php';
require_once __DIR__ . '/../../src/upload.php';
require_admin();
?>

<?php view('header', ['title' => "Reconnaissance de plaque d'immatriculation", 'js' => 'vehicule']) ?>


<div class="main">

    <?php view('sidebar', ['titre' => "Reconnaissance de plaque d'immatriculation"]) ?>



    <form enctype="multipart/form-data" action="" method="post">
        <div>
            <label for="file">Select a file:</label>
            <input type="file" id="file" name="file" />
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>


    <?php view('footer') ?>