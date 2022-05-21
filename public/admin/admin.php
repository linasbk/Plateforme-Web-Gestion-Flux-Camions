<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Admin']) ?>


<div class="main">
    <?php view('sidebar') ?>
    <div class="background">
        <div class="contenue">

            <titre>
                <strong>Bonjour administrateur</strong>
            </titre>
            <p>hello</p>

            <?php view('footer') ?>
        </div>
    </div>