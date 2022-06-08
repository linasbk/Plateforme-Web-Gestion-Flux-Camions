<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Gérer les  véhicules', 'js' => 'vehicule']) ?>


<div class="main">
    <?php view('sidebar', ['titre' => 'Gérer les véhicules']) ?>



    <?php
    #$date = "20" . date('y-n-d');
    csv_table('0', '');
    ?>


</div>
<?php view('footer') ?>