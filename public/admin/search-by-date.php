<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'rechercher véhicule', 'js' => 'vehicule']) ?>

<div class="main">

    <?php view('sidebar', ['titre' => 'Rechercher véhicule']) ?>


    <form class="form2" action="" method="post" enctype="multipart/form-data" name="bwdatesreport">

        <div>
            <label for="text-input">La date de début</label>
            <input type="date" name="fromdate" id="fromdate" required="true">
        </div>

        <div>
            <label for="email-input">La date de fin</label>
            <input type="date" name="todate" required="true">
        </div>

        <button type="submit" style="width:100%;" onclick="hidetab()" id="search" name="search">Rechercher</button>
    </form>

    <?php if (isset($_POST['search'])) {

        $fromdate = formatdate($_POST['fromdate']);
        $todate   = formatdate($_POST['todate']);

        csv_table(3, $fromdate);
    } ?>
</div>
<?php view('footer') ?>