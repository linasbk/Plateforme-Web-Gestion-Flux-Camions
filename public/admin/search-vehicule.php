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

            <form class="formsearch" method="post" enctype="multipart/form-data" name="search" id="formsearch">


                <label for="text-input" style="font-size:24px;">Rechercher véhicule
                </label>
                <input type="text" id="searchdata" name="searchdata" style="width: 100%;" required="required" autofocus="autofocus">

                <div class="searchselect">

                    <label for="searchtype">rechercher par:</label>
                    <select id="searchtype" name="searchtype">
                        <option value="0">Accès</option>
                        <option value="1">Matricule</option>
                        <option value="2">Date</option>
                        <option value="3">Heure</option>
                        <option value="4">image</option>
                        <option value="5">Sûreté</option>
                    </select>
                </div>


                <button type="submit" style="width:100%;" onclick="hidetab()" name="search">Search</button>
            </form>
            <?php if (isset($_POST['search'])) {
                csv_table("2022-5-23", $_POST['searchtype'], $_POST['searchdata']);
            } ?>

            <?php view('footer') ?>
        </div>
    </div>