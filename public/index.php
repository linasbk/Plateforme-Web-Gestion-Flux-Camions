<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<?php view('header', ['title' => 'Dashboard']) ?>

<?php view('sidebar') ?>
    
<?php view('footer') ?>