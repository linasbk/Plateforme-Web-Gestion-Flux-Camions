<?php

require __DIR__ . '/../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Login']) ?>

<p>hello admin</p>

<?php view('footer') ?>