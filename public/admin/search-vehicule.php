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
    if (csv_table("2022-5-23", $searchtype, $searchdata)) echo "<titre style='margin-top: 8em;;color:#f77d18;'>Aucun résultat trouvée<titre>";
    ?>



</div>
<?php view('footer') ?>