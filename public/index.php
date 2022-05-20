<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<?php view('header', ['title' => 'Dashboard']) ?>

<?php view('sidebar') ?>
<p>Welcome <?= current_user() ?> <a href="logout.php">Logout</a></p>



<?php view('footer') ?>