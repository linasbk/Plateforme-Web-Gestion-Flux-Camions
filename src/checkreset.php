<?php
function delete_reset_code_by_email($email)
{
    $sql = 'UPDATE users SET reset_code = NULL, reset_expiry = NULL WHERE email = :email ';

    $statement = db()->prepare($sql);

    $statement->bindValue(':email', $email);
    $statement->execute();
}

function find_reset_codes(string $reset_code, string $email)
{

    $sql = 'SELECT id,username,reset_code, reset_expiry < now() as expired
            FROM users
            WHERE email=:email';

    $statement = db()->prepare($sql);

    $statement->bindValue(':email', $email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // already expired, delete the in active user with expired activation code
        if ((int)$user['expired'] === 1) {
            delete_reset_code_by_email($email);
            return null;
        }
        // verify the password
        if (password_verify($reset_code, $user['reset_code'])) {

            return $user;
        }
    }

    return null;
}

#code run


if (is_user_logged_in()) {
    redirect_to('index.php');
}

if (find_reset_codes($_GET['reset_code'], $_GET['email']) != NULL) {

    $user = find_reset_codes($_GET['reset_code'], $_GET['email']);


    if (isset($_POST['submit']) && isset($user)) {


        $password = $_POST['confirmpassword'];
        $username = $user['username'];

        if (change_password($username, $password)) {
            delete_reset_code_by_email($_GET['email']);
            echo '<div style="width:min-width; padding: 6px; text-align:center; background-color:#0e171e ;color:white ; position:relative;" class="alert">Mot de passe changé avec succès</div>';
            redirect_with_message(
                'login.php',
                'Mot de passe changé avec succès.'
            );
        } else echo '<small class="info-red">erreur.<small>';
    }
} else {

    redirect_with_message(
        'forgot-password.php?email=' . $_GET['email'],
        "Le lien n'est plus valid."
    );
}
