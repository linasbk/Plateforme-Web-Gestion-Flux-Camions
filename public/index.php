<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<?php view('header', ['title' => 'Dashboard']) ?>




<div class="main">
    <?php view('user-sidebar') ?>
    <div class="background">
        <div class="contenue">

            <titre>
                <strong>Bonjour <?= current_user() ?> </strong>
            </titre>

            <?php view('footer') ?>