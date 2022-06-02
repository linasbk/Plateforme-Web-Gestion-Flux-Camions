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

    $sql = 'SELECT id, username,reset_code, reset_expiry < now() as expired
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

$user = find_reset_codes($_GET['reset_code'], $_GET['email']);

if (isset($_POST['submit']) && isset($user)) {


    $password = $_POST['confirmpassword'];
    $username = $user['username'];

    if (change_password($username, $password))
        echo '<small class="info">Mot de passe changé avec succès.<small>';
    else echo '<small class="info-red">Mot de passe actuel incorrect .<small>';
}
