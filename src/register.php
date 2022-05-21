<?php

if (is_user_logged_in()) {
    redirect_to('index.php');
}

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'username' => 'string | required | alphanumeric | between: 3, 25 | unique: users, username',
        'email' => 'email | required | email | unique: users, email',
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password',
        #'agree' => 'string | required'
    ];

    // custom messages
    $messages = [
        'password2' => [
            'required' => 'Veuiller réécrivez votre mot de passe.',
            'same' => 'Les mot de passe ne correspond pas.'
        ],
        'agree' => [
            'required' => 'Veuiller accepter les terms'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('register.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    $activation_code = generate_activation_code();

    if (register_user($inputs['email'], $inputs['username'], $inputs['password'], $activation_code)) {

        // send the activation email
        send_activation_email($inputs['email'], $activation_code);

        redirect_with_message(
            'login.php',
            'Veuillez vérifier votre e-mail pour activer votre compte avant de vous connecter'
        );
    }
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
