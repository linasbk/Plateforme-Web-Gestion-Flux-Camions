<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Gérer les  véhicules', 'js' => 'vehicule']) ?>

<body>
    <div class="main">
        <?php view('sidebar') ?>


        <titre>
            <strong>Gérer les véhicules</strong>
        </titre>
        <?php
        #$date = "20" . date('y-n-d');
        csv_table("2022-5-23", '0', 'IN');
        ?>
</body>



</html>