<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();

$searchtype = $_SESSION['searchtype'];
$searchdata = $_SESSION['searchdata']
?>

<?php view('header', ['title' => 'rechercher véhicule', 'js' => 'vehicule']) ?>


<div class="main">
    <?php view('sidebar') ?>
    <div class="background">
        <div class="contenue">

            <titre>
                Rechercher véhicule
            </titre>
            <?php
            csv_table("2022-5-23", $searchtype, $searchdata);
            ?>

            <?php view('footer') ?>
        </div>
    </div>