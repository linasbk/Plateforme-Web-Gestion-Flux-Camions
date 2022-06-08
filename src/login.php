<?php


if (is_user_logged_in() && is_user_approved()) {
    redirect_to('okk.php');
}

$inputs = [];
$errors = [];

if (is_post_request()) {

    [$inputs, $errors] = filter($_POST, [
        'username' => 'string | required',
        'password' => 'string | required',
        'remember_me' => 'string'
    ]);


    if ($errors) {

        redirect_with('login.php', ['errors' => $errors, 'inputs' => $inputs]);
    }

    if (!is_user_exist($inputs['username'])) {

        $errors['login'] = "Le compte n'exist pas.";

        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    } else if (!check_password($inputs['username'], $inputs['password'])) {


        $email = get_email($inputs['username']);
        $_SESSION['email'] = $email;


        $errors['login'] = "Le mot de passe que vous avez entré est incorrect. <a class='forgot-password' href='forgot-password.php'> Mot de passe oublié?</a>";


        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    } else if (!is_active($inputs['username'])) {

        $email = get_email($inputs['username']);
        $_SESSION['email'] = $email;

        $errors['login'] = "Le compte n'a pas été activer par email. <a href='resend.php' class='forgot-password' name='renvoyer' >Renvoyer?</a>";


        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    } else if (!is_approved($inputs['username'])) {



        $errors['login'] = "Le compte n'a pas été activer par l'admin.";


        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }


    // if login fails
    if (!login($inputs['username'], $inputs['password'], isset($inputs['remember_me']))) {



        $errors['login'] =  "autre error.";

        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }


    // login successfully

    if (is_user_admin() && is_user_approved()) redirect_to('admin/admin.php');

    if (is_user_approved()) redirect_to('okk.php');
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
