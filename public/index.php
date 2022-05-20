<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='css/style.css' href='/css/style.css'>
    <title><?= $title ?? 'Home' ?></title>
</head>

<body>
    <main>
        <?php flash() ?>

        <?php view('sidebar') ?>




        <?php view('footer') ?>