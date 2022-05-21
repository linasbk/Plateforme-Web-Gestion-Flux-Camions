<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Gérer les utilisateurs']) ?>

<body>
    <div class="main">
        <?php view('sidebar') ?>
        <div class="background">
            <div class="contenue">


                <titre>
                    <strong>Gérer les véhicules</strong>
                </titre>

                <table>

                    <tr>

                        <th>Accès</th>
                        <th>Matricule</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>image</th>
                        <th>Sûreté</th>



                    </tr>
                    <tr>
                        <?php
                        $f = fopen("../files/-2019-01-02-.csv", "r");
                        fgetcsv($f); #skips the first line
                        $columns = array(1, 3); #select wich columns you want to show
                        while (($line = fgetcsv($f)) !== false) {
                            echo "<tr>";
                            foreach ($line as $cell) { {
                                    $value = explode(';', $cell);
                                    foreach ($value as $word)  echo "<td>" . htmlspecialchars($word) . "</td>";
                                }
                            }
                            echo "</tr>\n";
                        }
                        fclose($f);
                        ?>
                    </tr>
                </table>
</body>

</html>