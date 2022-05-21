
<?php

$inputs = [];
$errors = [];

if (is_post_request()) {


    if (isset($_POST['submit'])) {

        $id = $_POST['id'];
        toggle_approval($id);
    }
}
