

<?php

function csv_magic($searchcolumn, $searchvalue)
{
    echo "<table>
    <tr>
        <th>Accès</th>
        <th>Matricule</th>
        <th>Date</th>
        <th>Heure</th>
        <th>image</th>
        <th>Sûreté</th>
    </tr>
    <tr>";

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
    echo "</tr>
    </table>";
}
