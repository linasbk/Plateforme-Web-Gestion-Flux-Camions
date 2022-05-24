<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
require __DIR__ . '/../../src/vehicule.php';
?>

<?php view('header', ['title' => 'Gérer les  véhicules']) ?>

<body>
    <div class="main">
        <?php view('sidebar') ?>
        <div class="background">
            <div class="contenue">


                <titre>
                    <strong>Gérer les véhicules</strong>
                </titre>
                <?php
                #$date = "20" . date('y-n-d');
                csv_table("2022-5-23", '0', 'IN');
                ?>
</body>



</html>