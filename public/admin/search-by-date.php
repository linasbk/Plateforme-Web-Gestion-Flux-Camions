<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
require __DIR__ . '/../../src/vehicule.php';
?>

<?php view('header', ['title' => 'rechercher véhicule']) ?>


<div class="main">
    <?php view('sidebar') ?>
    <div class="background">
        <div class="contenue">

            <titre>
                Rechercher véhicule
            </titre>


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

                $fromdate =  date($_POST['fromdate']);
                $todate =  date($_POST['todate']);

                csv_table($todate, 0, 'IN');
            } ?>

            <?php view('footer') ?>
        </div>
    </div>