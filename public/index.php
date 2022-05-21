<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<?php view('header', ['title' => 'Login']) ?>

<?php view('sidebar') ?>
    
<?php view('footer') ?>