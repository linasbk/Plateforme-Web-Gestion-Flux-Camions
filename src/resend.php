<?php


function delete_activation_code_by_email($email)
{
    $sql = 'UPDATE users SET activation_code = NULL, activation_expiry = NULL WHERE email = :email ';

    $statement = db()->prepare($sql);

    $statement->bindValue(':email', $email);
    $statement->execute();
}

if (is_user_logged_in()) {
    redirect_to('index.php');
}


function fill_activation_values($email, $activation_code, $activation_expiry =  1 * 24  * 60 * 60)
{


    $sql = 'UPDATE users SET activation_code = :activation_code, activation_expiry = :activation_expiry WHERE email = :email ';

    $statement = db()->prepare($sql);
    $statement->bindValue(':email', $email);

    $statement->bindValue(':activation_code', password_hash($activation_code, PASSWORD_DEFAULT));
    $statement->bindValue(':activation_expiry', date('Y-m-d H:i:s',  time() + $activation_expiry));

    return $statement->execute();
}


if (is_post_request()) {

    if (isset($_POST['email'])) $email = $_POST['email'];
    if (check_email($email)) {

        $activation_code = generate_activation_code();

        delete_activation_code_by_email($email);
        fill_activation_values($email, $activation_code);
        send_activation_email($email, $activation_code);

        echo '<div style="width:min-width; padding: 6px; text-align:center; background-color:#0e171e ;color:white ; position:relative;" class="alert">Email envoyé avec succès.</div>';

        redirect_with_message(
            'login.php',
            'Email renvoyer avec succès.'
        );
    } else echo '<div style="width:min-width; padding: 6px; text-align:center; background-color:#0e171e ;color:white ; position:relative;" class="alert">Email incorrect.</div>';
}
