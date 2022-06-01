<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Admin', 'js' => 'vehicule']) ?>


<div class="main">
    <?php view('sidebar', ['titre' => 'Dashboard']) ?>

    <div class="dashboard">

        <div>
            <img class="truck " src="../images/truck3.png" alt="truck">
            <div>
                <span><?php csv_unique("2022-5-23", '1') ?></span>
                <p>Véhicules entrés aujourd'hui</p>
            </div>

        </div>


        <div>
            <img class="truck " src="../images/truck.png" alt="truck">
            <div><span>2</span>
                <p>Véhicules entrés hier</p>
            </div>
        </div>

        <div>
            <img class="truck " src="../images/truck1.png" alt="truck">
            <div>
                <span>4</span>
                <p>Véhicules entrés cette semaine</p>
            </div>

        </div>


        <div>
            <img class="truck" src="../images/truck2.png" alt="truck">
            <div>
                <span>5</span>
                <p>Totale de véhicules entrés</p>
            </div>
        </div>

    </div>

    <?php view('footer') ?>