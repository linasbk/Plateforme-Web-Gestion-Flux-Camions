<?php
if (isset($_POST['submit'])) {

    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);


    if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {

        $image = $_FILES['file'];

        $output = "../files/uploads/" . $image['name'];
        move_uploaded_file($image['tmp_name'],   $output);

        echo '<img src="' . $output . '" alt="aucune image" width="120px" height="120px">';
    } else {

        echo "File is not image";
    }
}
