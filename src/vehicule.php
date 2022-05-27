<?php
function formatdate($date)
{

    $timestamp = strtotime($date);
    $date =  "20" . date('y-n-d', $timestamp);
    return $date;
}

function csv_table($date, $searchcolumn, $searchvalue)
{
    echo "<table  border='1' cellpadding='15' id='searchtable' class=''>
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

    echo "<td class='imagetd'>" . "<img alt='image' class='imagestyle' onclick='show(this)' src='/auth/files/$hour/$image'
                            width='120' height='75' > " . "</td>";
}


function show_html($html, $color)
{
    echo "<td style='color:$color'>" . htmlspecialchars($html) . "</td>";
}


function color_html($word)
{

    if (strpos($word, '%') !== false || strpos($word, 'IN') !== false) {
        if (trim($word, '%') >= 80)
            show_html($word, 'green');
        elseif (trim($word, '%') <= 60)
            show_html($word, 'orange');

        else show_html($word, 'red');
    } elseif (strpos($word, 'OUT') !== false) show_html($word, 'red');

    else show_html($word, 'black');
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

            if (isset($value[$searchcolumn]) && stripos($value[$searchcolumn], trim($searchvalue)) !== false) {

                foreach ($value as $word) {

                    if (is_image($word)) show_image($word);
                    else
                        color_html($word);
                }
            }
        }
        echo "</tr>\n";
    }
    fclose($f);
}
