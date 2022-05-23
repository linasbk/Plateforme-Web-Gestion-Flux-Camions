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



                        $date = "20" . date('y-n-d');

                        $f = fopen("../files/-$date-.csv", "r");

                        fgetcsv($f); #skips the first line

                        $extension = '/^.*\.(jpg|jpeg|png)$/i';

                        while (($line = fgetcsv($f)) !== false) {

                            echo "<tr>";

                            foreach ($line as $cell) { {
                                    $value = explode(';', $cell);

                                    foreach ($value as $word)

                                        if (preg_match($extension, $word, $matches)) {


                                            $hour = explode("_", $word);
                                            $hour =  $hour[1];
                                            $hour = explode("-", $hour);
                                            $hour =  $hour[0];

                                            echo "<td class='imagetd'>" . "
                                            <img alt='image' class='' onclick='show(this)' src='/auth/files/$hour/$word'
                                            width='120' height='70' style='padding:2px;'>
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

<style>
    .center {
        z-index: 5;
        position: absolute;
        top: 45%;
        right: 40%;
        margin: 0px;
        padding: 0px;


    }
</style>

<script>
    flag = 0;

    function show(el) {

        img = el;

        if (flag == 1) {
            flag = 0;
            // Set image size to original
            img.style.transform = "scale(1)";
            img.style.transition = "transform 0.55s ease";
            img.classList.remove("center");


        } else if (flag == 0) {
            flag = 1;
            img.classList.add("center");
            // Set image size to 1.5 times original
            img.style.transform = "scale(8)";
            // Animation effect
            img.style.transition = "transform 0.55s ease";

        }
        console.log("after: " + flag)
    }
</script>

</html>