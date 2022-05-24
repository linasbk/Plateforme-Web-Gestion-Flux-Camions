<?php
function csv_table($date, $searchcolumn, $searchvalue)
{
    echo "<table id='searchtable' class=''>
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
    search_csv($date, $searchcolumn, $searchvalue);
    echo   "</tr>
            </table>";
}

function is_image($image): bool
{

    $extension = '/^.*\.(jpg|jpeg|png)$/i';
    if (preg_match($extension, $image, $matches)) return true;
    return false;
}

function show_image($image)
{
    $hour = explode("_", $image);
    $hour =  $hour[1];
    $hour = explode("-", $hour);
    $hour =  $hour[0];

    echo "<td class='imagetd'>" . "<img alt='image' class='' onclick='show(this)' src='/auth/files/$hour/$image'
                            width='120' height='70' style='padding:2px;'> " . "</td>";
}

function show_html($html)
{
    echo "<td>" . htmlspecialchars($html) . "</td>";
}

function search_csv($date, $searchcolumn, $searchvalue)
{


    # $f = fopen("../files/-$date-.csv", "r");
    $f = fopen("../files/-$date-.csv", "r");

    fgetcsv($f); #skips the first line


    while (($line = fgetcsv($f)) !== false) {

        echo "<tr>";

        foreach ($line as $cell) {

            $value = explode(';', $cell);

            if (isset($value[$searchcolumn]) && $value[$searchcolumn] == $searchvalue) {

                foreach ($value as $word) {

                    if (is_image($word)) show_image($word);
                    else show_html($word);
                }
            }
        }
        echo "</tr>\n";
    }
    fclose($f);
}


?>

<script>
    flag = 0;

    function show(el) {

        img = el;

        if (flag == 1) {
            flag = 0;
            // Set image size to original
            img.style.transform = "scale(1)";
            img.style.transition = "transform 0.80s ease";
            img.classList.remove("center");


        } else if (flag == 0) {
            flag = 1;
            img.classList.add("center");
            // Set image size to 1.5 times original
            img.style.transform = "scale(8)";
            // Animation effect
            img.style.transition = "transform 0.7s ease";

        }

    }

    function hidetab() {
        console.log("ahoy");
        form = document.getElementById("formsearch");

        form.classList.add("formtop");

    }
</script>

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