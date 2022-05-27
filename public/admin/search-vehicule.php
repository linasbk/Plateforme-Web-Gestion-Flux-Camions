<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();

$searchtype = $_SESSION['searchtype'];
$searchdata = $_SESSION['searchdata']
?>

<?php view('header', ['title' => 'rechercher véhicule', 'js' => 'vehicule']) ?>


<div class="main">

    <?php view('sidebar', ['titre' => 'Rechercher véhicule']) ?>

    <?php
    csv_table("2022-5-23", $searchtype, $searchdata);
    ?>
    <input class="imprimer" type="button" onclick="impri()" value="Imprimé" />


</div>
<?php view('footer') ?>