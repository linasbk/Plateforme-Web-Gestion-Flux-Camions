<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


require 'remember.php';
/**
 * Register a user
 *
 * @param string $email
 * @param string $username
 * @param string $password
 * @param bool $is_admin
 * @return bool
 */


function register_user(string $email, string $username, string $password, string $activation_code, int $expiry = 1 * 24  * 60 * 60, bool $is_admin = false): bool
{
    $sql = 'INSERT INTO users(username, email, password, is_admin, activation_code, activation_expiry , approved)
            VALUES(:username, :email, :password, :is_admin, :activation_code,:activation_expiry ,:approved )';

    #give a  way to set the admin account
    if ($username == "admin") {
        $is_admin = 1;
        $is_approved = 1;
    }

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));

    $statement->bindValue(':is_admin', (int)$is_admin, PDO::PARAM_INT);
    $statement->bindValue(':approved', (int)$is_approved, PDO::PARAM_INT);

    $statement->bindValue(':activation_code', password_hash($activation_code, PASSWORD_DEFAULT));
    $statement->bindValue(':activation_expiry', date('Y-m-d H:i:s',  time() + $expiry));

    return $statement->execute();
}

function find_user_by_username(string $username)
{
    $sql = 'SELECT username, password, active, email, id , is_admin , approved
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function find_unnapproved_users()
{
    $sql = 'SELECT username, email, id , approved
            FROM users where is_admin = 0 ';

    $statement = db()->prepare($sql);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function log_user_in($user)
{
    // prevent session fixation attack
    session_regenerate_id();

    // set username in the session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    return true;
}

function remember_me(int $user_id, int $day = 30)
{
    [$selector, $validator, $token] = generate_tokens();

    // remove all existing token associated with the user id
    delete_user_token($user_id);

    // set expiration date
    $expired_seconds = time() + 60 * 60 * 24 * $day;

    // insert a token to the database
    $hash_validator = password_hash($validator, PASSWORD_DEFAULT);
    $expiry = date('Y-m-d H:i:s', $expired_seconds);

    if (insert_user_token($user_id, $selector, $hash_validator, $expiry)) {
        setcookie('remember_me', $token, $expired_seconds);
    }
}


function login(string $username, string $password, bool $remember = false): bool
{

    $user = find_user_by_username($username);

    // if user found, check the password
    if ($user && is_user_active($user) && password_verify($password, $user['password'])) {

        log_user_in($user);

        if ($remember) {
            remember_me($user['id']);
        }

        return true;
    }

    return false;
}


function is_user_logged_in(): bool
{
    // check the session
    if (isset($_SESSION['username'])) {
        return true;
    }

    // check the remember_me in cookie
    $token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_UNSAFE_RAW);

    if ($token && token_is_valid($token)) {

        $user = find_user_by_token($token);

        if ($user) {
            return log_user_in($user);
        }
    }
    return false;
}

function is_user_admin(): bool
{
    $username = $_SESSION['username'];
    $user = find_user_by_username($username);
    if ($user['is_admin'])
        return true;

    return false;
}



function require_login(): void
{
    if (!is_user_logged_in()) {
        redirect_to('login.php');
    }
}


function require_admin(): void
{

    require_login(); // check if the user is logged in
    if (!is_user_admin()) {
        redirect_to('index.php');
    }
}

function redirect_admin(): void
{
    if (is_user_admin()) {
        redirect_to('admin/admin.php');
    }
}



function logout(): void
{
    if (is_user_logged_in()) {

        // delete the user token
        delete_user_token($_SESSION['user_id']);

        // delete session
        unset($_SESSION['username'], $_SESSION['user_id`']);

        // remove the remember_me cookie
        if (isset($_COOKIE['remember_me'])) {
            unset($_COOKIE['remember_me']);
            setcookie('remember_user', null, -1);
        }

        // remove all session data
        session_destroy();

        // redirect to the login page
        redirect_to('login.php');
    }
}

function current_user()
{
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}

function is_user_active($user)
{
    return (int)$user['active'] === 1;
}

function generate_activation_code(): string
{
    return bin2hex(random_bytes(16));
}

function send_activation_email(string $email, string $activation_code): void
{

    // create the activation link
    $activation_link = APP_URL . "/activate.php?email=$email&activation_code=$activation_code";

    // set email subject & body
    $subject = ' Veuillez activer votre compte';
    $message = <<<MESSAGE
            Bonjour,
            Veuillez cliquer sur le lien suivant pour activer votre compte :
            $activation_link
            MESSAGE;
    // email header
    $header = "From: " . "innovatelsup@gmail.com";

    // send the email

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "innovatel.sup@gmail.com";
    $mail->Password   = "Innovatel12345";

    $mail->IsHTML(true);
    $mail->AddAddress($email, "client");
    $mail->SetFrom("innovatel.sup@gmail.com", "innovatel");

    $mail->Subject = $subject;
    $mail->MsgHTML($message);
    $mail->Send();
}

function delete_user_by_id(int $id, int $active = 0)
{
    $sql = 'DELETE FROM users
            WHERE id =:id and active=:active';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':active', $active, PDO::PARAM_INT);

    return $statement->execute();
}

function find_unverified_user(string $activation_code, string $email)
{

    $sql = 'SELECT id, activation_code, activation_expiry < now() as expired
            FROM users
            WHERE active = 0 AND email=:email';

    $statement = db()->prepare($sql);

    $statement->bindValue(':email', $email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // already expired, delete the in active user with expired activation code
        if ((int)$user['expired'] === 1) {
            delete_user_by_id($user['id']);
            return null;
        }
        // verify the password
        if (password_verify($activation_code, $user['activation_code'])) {
            return $user;
        }
    }

    return null;
}

function activate_user(int $user_id): bool
{
    $sql = 'UPDATE users
            SET active = 1,
                activated_at = CURRENT_TIMESTAMP
            WHERE id=:id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $user_id, PDO::PARAM_INT);

    return $statement->execute();
}

// function approve_user(int $user_id): bool
// {
//     $sql = 'UPDATE users
//             SET approved = 1,
//                 approved_at = CURRENT_TIMESTAMP
//             WHERE id=:id';

//     $statement = db()->prepare($sql);
//     $statement->bindValue(':id', $user_id, PDO::PARAM_INT);

//     return $statement->execute();
// }



function check_approval(int $user_id): bool
{

    $sql = 'select approved from users
            where id=:id';
    $statement = db()->prepare($sql);

    $statement->bindValue(':id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch();

    return $result['approved'];
}

function toggle_approval(int $user_id): bool
{
    $approval = check_approval($user_id) ? 0 : 1;

    $sql = 'update users
    set approved = :approval,
        approved_at = CURRENT_TIMESTAMP
    where id=:id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $user_id, PDO::PARAM_INT);
    $statement->bindValue(':approval', $approval, PDO::PARAM_INT);

    return $statement->execute();
}

function is_user_approved(): bool
{

    $username = $_SESSION['username'];
    $user = find_user_by_username($username);
    if ($user['approved'])
        return true;

    return false;
}
