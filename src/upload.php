<?php

use thiagoalessio\TesseractOCR\TesseractOCR;

use function PHPSTORM_META\type;

function tocr($output = '../files/uploads/tocr.jpg')
{
    //using only php and tesseract
    $results = (new TesseractOCR($output))
        ->lang('ara', 'eng')
        ->hocr()
        ->run();

    if ($results)
        return  $results;
    else return "aucun resultat";
}


function tocr2()
{
    //using python
    $pyout = exec('python ../public/py/lpr.py ../public/files/uploads/tocr.jpg');
    #$pyout = exec('python ../public/py/finale.py ../public/files/uploads/tocr.jpg');
    return $pyout;
}




if (isset($_POST['submit'])) {

    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);


    if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {

        $image = $_FILES['file'];

        $output = "../files/uploads/" . 'tocr.' . $extension;
        move_uploaded_file($image['tmp_name'],   $output);
    }
}
