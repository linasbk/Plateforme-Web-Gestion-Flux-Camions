<?php


function generate_activate_code(): string
{
    return bin2hex(random_bytes(16));
}

if (is_user_logged_in()) {
    redirect_to('index.php');
}

if (is_post_request()) {

    $email = $_SESSION['email'];
    if (check_email($email)) {

        $activation_code = generate_activate_code();

        if (send_activation_email($email, $activation_code)) {

            redirect_with_message(
                'login.php',
                'Email renvoyer avec succès.'
            );
        }
    } else {
        redirect_with_message(
            'login.php',
            'Email incorrect.'
        );
    }
}
