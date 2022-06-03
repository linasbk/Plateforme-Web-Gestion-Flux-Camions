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
    $sql = 'INSERT INTO users(username, email, password, is_admin, active ,activation_code, activation_expiry , approved)
            VALUES(:username, :email, :password, :is_admin, :active, :activation_code,:activation_expiry ,:approved )';

    #give a  way to set the admin account
    if ($username == "admin") {
        $is_admin = 1;
        $is_approved = 1;
        $is_active = 1;
    }

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));

    $statement->bindValue(':is_admin', (int)$is_admin, PDO::PARAM_INT);
    $statement->bindValue(':approved', (int)$is_approved, PDO::PARAM_INT);
    $statement->bindValue(':active', (int)$is_active, PDO::PARAM_INT);

    $statement->bindValue(':activation_code', password_hash($activation_code, PASSWORD_DEFAULT));
    $statement->bindValue(':activation_expiry', date('Y-m-d H:i:s',  time() + $expiry));

    return $statement->execute();
}

function check_password(string $username, string $password): bool
{
    $sql = 'select password FROM users WHERE username = :username';
    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $results = $statement->fetch();

    $sqlpassword = $results['password'];

    $same_password = password_verify($password, $sqlpassword);

    if ($same_password) return true;
    return false;
}

function get_email(string $username)
{

    $user = find_user_by_username($username);

    return $user['email'];
}


function check_email(string $email): bool
{
    if ($email ==  $_SESSION['email']) return true;
    return false;
}

function change_password(string $username, string $password): bool
{
    $sql = 'UPDATE users SET password = :password WHERE username = :username';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);

    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));

    return $statement->execute();
}




function find_user_by_username(string $username)
{
    $sql = 'SELECT username, password, active, email, id , is_admin , approved ,is_read_admin
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function find_users()
{
    $sql = 'SELECT username, email, id , approved
            FROM users where is_admin = 0 ';

    $statement = db()->prepare($sql);
    $statement->execute();


    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function users_exist()
{

    $sql = 'SELECT username, email, id , approved
    FROM users where is_admin = 0 ';

    $statement = db()->prepare($sql);
    $statement->execute();

    $rows =  $statement->rowCount();
    return  $rows;
}
function users_exist_innaproved()
{

    $sql = 'SELECT username, email, id , approved
    FROM users where is_admin = 0 and approved = 0 ';

    $statement = db()->prepare($sql);
    $statement->execute();

    $rows =  $statement->rowCount();

    return  $rows;
}


function delete_user($id)
{
    $sql = 'DELETE FROM users WHERE id =:id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
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


function is_user_read_admin(): bool
{
    $username = $_SESSION['username'];
    $user = find_user_by_username($username);
    if ($user['is_read_admin'])
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
    $subject = 'Veuillez activer votre compte';
    $message = '<!DOCTYPE html>
    <html>
    
    <head>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <style type="text/css">
        body {
            background-color: #88BDBF;
            margin: 0px;
        }
    </style>
    
    <body>
        <table border="0" width="50%" style="margin:auto;padding:30px;background-color: #F3F3F3;border:1px solid #FF7A5A;">
    
            <tr>
                <td>
                    <table border="0" cellpadding="0" cellspacing="0" style="text-align:center;width:100%;background-color: #fff;">
                        <tr>
                            <td style="background-color:#ff6b00;height:100px;font-size:50px;color:#fff;">
                                <table border="0" width="100%">
                                    <tr>
                                        <td>
                                            <img src="https://i.imgur.com/IAYN14n.png" style="padding-top:20px" alt="" width="100px" height="90px">
                                        </td>
                                    </tr>
                                </table>
                            </td>
    
                        </tr>
                        <tr>
                            <td>
                                <h1 style="padding-top:25px;">Bonjour!</h1>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="color:black; font-size:16px; padding:0px 100px; padding-bottom:10px; margin-bottom: 30px;">
                                    Veuillez cliquer sur ce bouton pour activer votre compte :
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <a  href="' . $activation_link . '" style="margin:10px 0px 30px 0px; border-radius:4px;  text-decoration: none; padding:10px 20px;border: 0;color:#fff;background-color:#ff6b00;">Vérifier votre email</a>
                            </td>
                        </tr>
                        <br>
                       
                        <tr>
                            <td>
                            <pre style="color:black;font:size:16px padding-bottom:10px;">
Si cela ne fonctionne pas, veuillez copiez et 
collez le lien suivant dans votre navigateur :</pre>

                                <a href="' . $activation_link . '">' . $activation_link . '</a>
                            </td>
                         
                        </tr>
    
                    </table>
                </td>
            </tr>
            <tr>
                <td>
    
    </body>
    
    </html>';


    // send the email

    $mail = new PHPMailer();
    #$mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = SENDER_MAIL;
    $mail->Password   = SENDER_PASS;


    $mail->IsHTML(true);
    $mail->AddAddress($email, "client");
    $mail->SetFrom("Innovatel.sup@gmail.com", "innovatel", 0);

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

function is_user_exist($username): bool
{

    $user = find_user_by_username($username);
    if ($user['username'])
        return true;

    return false;
}



function is_approved($username): bool
{

    $user = find_user_by_username($username);
    if ($user['approved'])
        return true;

    return false;
}



function is_active($username): bool
{

    $user = find_user_by_username($username);
    if ($user['active'])
        return true;

    return false;
}

function secure_password($password): bool
{

    #$pattern = "#.*^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#";
    $pattern = "#.*^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#"; #for special charachters
    return preg_match($pattern, $password);
}
