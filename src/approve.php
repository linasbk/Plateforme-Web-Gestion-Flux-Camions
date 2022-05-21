<?php

$inputs = [];
$errors = [];

if (is_post_request()) {

    [$inputs, $errors] = filter($_POST, []);

    if ($errors)
        echo "error";

    if (isset($_POST['submit'])) {

        $id = $_POST['id'];
        approve_user($id);
    }
}
