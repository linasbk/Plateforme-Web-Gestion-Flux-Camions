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
                <span><?php echo csv_table('0', 'in', '0') ?></span>
                <p>Véhicules entrés aujourd'hui</p>
            </div>

        </div>


        <div>
            <img class="truck " src="../images/truck.png" alt="truck">
            <div><span><?php echo csv_table('0', 'out', '0') ?></span>
                <p>Véhicules sortis aujourd'hui</p>
            </div>
        </div>


        <div>
            <img class="truck" src="../images/truck2.png" alt="truck">
            <div>
                <span><?php echo csv_unique('1') ?></span>
                <p>Totale de véhicules</p>
            </div>
        </div>

    </div>

    <?php view('footer') ?>