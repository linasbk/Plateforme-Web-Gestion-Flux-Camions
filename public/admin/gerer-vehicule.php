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
                        $pattern = '/^.*\.(jpg|jpeg|png)$/i';

                        $f = fopen("../files/-2019-01-02-.csv", "r");
                        fgetcsv($f); #skips the first line
                        while (($line = fgetcsv($f)) !== false) {
                            echo "<tr>";
                            foreach ($line as $cell) { {
                                    $value = explode(';', $cell);
                                    foreach ($value as $word)

                                        if (preg_match($pattern, $word, $matches)) {
                                            $hour = explode("_", $word);
                                            $hour =  $hour[1];
                                            $hour = explode("-", $hour);
                                            $hour =  $hour[0];

                                            echo "<td>" . "
                                            <img alt='image' src='/auth/files/$hour/$word'
                                            width='80' height='50'>
                                           " . "</td>";
                                        } else echo "<td>" . htmlspecialchars($word) . "</td>";
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