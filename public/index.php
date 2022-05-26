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
            <a href="logout.php">
                <i class='bx bx-log-out icon'></i>
                <span class="text nav-text">
                    <p>Déconnexion</p>
                </span>
            </a>
        </div>
    </div>
</div>
<?php view('footer') ?>