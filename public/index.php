<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();
redirect_admin();
?>

<?php view('header', ['title' => 'Dashboard']) ?>


<div class="main">
    <div class="background">
        <div class="contenue">

            <titre>
                <strong>Bonjour <?= current_user() ?> </strong>
            </titre>
            <?php redirect_to('okk.php'); ?>
        </div>
    </div>
</div>
<?php view('footer') ?>