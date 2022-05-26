<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Gérer les  véhicules', 'js' => 'vehicule']) ?>


<div class="main">
    <?php view('sidebar') ?>


    <titre>
        <strong>Gérer les véhicules</strong>
    </titre>
    <?php
    #$date = "20" . date('y-n-d');
    csv_table("2022-5-23", '2', '2019');
    ?>

    <input class="imprimer" type="button" onclick="impri()" value="Imprimé" />
</div>
<?php view('footer') ?>