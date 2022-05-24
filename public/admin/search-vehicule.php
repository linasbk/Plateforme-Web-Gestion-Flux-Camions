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

            <form class="formsearch" action="" method="post" enctype="multipart/form-data" class="form-horizontal" name="search">


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




                <button type="submit" style="width:100%;" name="search">Search</button>
            </form>



            <?php

            if (isset($_POST['search'])) {
                echo "<table>
 
            <tr>
                <th>Accès</th>
                <th>Matricule</th>
                <th>Date</th>
                <th>Heure</th>
                <th>image</th>
                <th>Sûreté</th>
            
            </tr>
            <tr>
              ";


                $searchcolumn = $_POST['searchtype'];
                $searchvalue = $_POST['searchdata'];


                $date = "20" . date('y-n-d');

                # $f = fopen("../files/-$date-.csv", "r");
                $f = fopen("../files/-2022-5-23-.csv", "r");

                fgetcsv($f); #skips the first line

                $extension = '/^.*\.(jpg|jpeg|png)$/i';

                while (($line = fgetcsv($f)) !== false) {

                    echo "<tr>";

                    foreach ($line as $cell) {

                        $value = explode(';', $cell);

                        if (isset($value[$searchcolumn]) && $value[$searchcolumn] == $searchvalue) {

                            foreach ($value as $word) {

                                if (preg_match($extension, $word, $matches)) {


                                    $hour = explode("_", $word);
                                    $hour =  $hour[1];
                                    $hour = explode("-", $hour);
                                    $hour =  $hour[0];

                                    echo "<td class='imagetd'>" . "<img alt='image' class='' onclick='show(this)' src='/auth/files/$hour/$word'
                                                        width='120' height='70' style='padding:2px;'> " . "</td>";
                                } else echo "<td>" . htmlspecialchars($word) . "</td>";
                            }
                        }
                    }
                    echo "</tr>\n";
                }
                fclose($f);
                echo "   </tr>
                         </table>";
            }

            ?>
            <?php view('footer') ?>
        </div>
    </div>