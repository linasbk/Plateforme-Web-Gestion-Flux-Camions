<?php
function formatdate($date)
{

    $timestamp = strtotime($date);
    $date =  "20" . date('y-n-d', $timestamp);
    return $date;
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

function  csv_table($searchcolumn, $searchvalue, $print = '1', $date = FILE_DATE)
{

    $check = true;
    if ($print) {
        $tabheader = "<table  border='1' cellpadding='15' id='searchtable' class=''>
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
    }


    # $f = fopen("../files/-$date-.csv", "r");
    $f = fopen("../files/-$date-.csv", "r");

    fgetcsv($f); #skips the first line

    $number = 0;
    while (($line = fgetcsv($f)) !== false) {


        foreach ($line as $cell) {

            $value = explode(';', $cell);

            if (isset($value[$searchcolumn]) && stripos($value[$searchcolumn], trim($searchvalue)) !== false) {

                if ($check  && $print) {
                    echo $tabheader;
                    $check = false;
                }


                foreach ($value as $word) {
                    if ($print) {
                        if (is_image($word)) show_image($word);
                        else
                            color_html($word);
                    }
                }
                $number++;
                if ($print) echo "</tr>\n";
            }
        }
    }
    fclose($f);
    if (!$check && $print) echo "</tr>
    </table> <input class='imprimer' type='button' onclick='impri()' value='Imprimé'/>
    ";

    return $number;
}

function csv_unique($column, $date = FILE_DATE)
{
    // this array will hold the results
    $unique = array();

    $f = fopen("../files/-$date-.csv", "r");
    fgetcsv($f); #skips the first line

    // read the rows of the csv file
    while (($line = fgetcsv($f)) !== false) {

        foreach ($line as $cell) {
            $value = explode(';', $cell);

            if (isset($value[$column])) $unique[] = $value[$column];
        }
    }

    $result = array_unique($unique);
    $result = array_filter($result);

    return (count($result));
}
