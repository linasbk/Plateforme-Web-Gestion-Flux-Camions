<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();

$searchtype = $_SESSION['searchtype'];
$searchdata = $_SESSION['searchdata']
?>

<?php view('header', ['title' => 'rechercher véhicule', 'js' => 'vehicule']) ?>


<div class="main">
    <?php view('sidebar') ?>

    <titre>
        Rechercher véhicule
    </titre>
    <?php
    csv_table("2022-5-23", $searchtype, $searchdata);
    ?>
    <input class="imprimer" type="button" onclick="imprimir()" value="Imprimé" />

    <script type="text/javascript">
        function imprimir() {
            var divToPrint = document.getElementById("searchtable");
            divToPrint.style.border = "1px solid black";
            divToPrint.style.borderCollapse = "collapse";
            newWin = window.open("");
            newWin.document.write("<br><br>");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>

</div>
<?php view('footer') ?>