<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generate_reset_code(): string
{
    return bin2hex(random_bytes(16));
}


function send_Reset_email(string $email, string $reset_code): void
{

    // create the activation link
    $reset_link = APP_URL . "/reset.php?email=$email&reset_code=$reset_code";

    // set email subject & body
    $subject = 'Veuillez changer votre mot de passe';
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
                                    Veuillez cliquer sur ce bouton pour modifier votre mot de passe :
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <a  href="' .  $reset_link . '" style="margin:10px 0px 30px 0px;border-radius:4px;  text-decoration: none; padding:10px 20px;border: 0;color:#fff;background-color:#ff6b00;">modifier</a>
                            </td>
                        </tr>
            
                        <br>
                       
                        <tr>
                            <td>
                            <p style="margin:10px 0px 30px 0px;border-radius:4px;  text-decoration: none; padding:10px 20px;border: 0;color:#fff;background-color:#ff6b00;">se lien va expirer dans 20 minutes</p>
                            <pre style="color:black;font:size:16px padding-bottom:10px;">
Si cela ne fonctionne pas, veuillez copiez et 
collez le lien suivant dans votre navigateur :</pre>

                                <a href="' .  $reset_link . '">' . $reset_link . '</a>
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



function fill_reset_values($email, $reset_code, $reset_expiry =   20 * 60)
{


    $sql = 'UPDATE users SET reset_code = :reset_code, reset_expiry = :reset_expiry WHERE email = :email ';

    $statement = db()->prepare($sql);
    $statement->bindValue(':email', $email);

    $statement->bindValue(':reset_code', password_hash($reset_code, PASSWORD_DEFAULT));
    $statement->bindValue(':reset_expiry', date('Y-m-d H:i:s',  time() + $reset_expiry));

    return $statement->execute();
}

if (is_post_request()) {

    if (is_user_logged_in()) {
        redirect_to('okk.php');
    }

    if (isset($_POST['submit']) && isset($_SESSION['email'])) {


        $email = $_POST['email'];

        $reset_code = generate_reset_code();

        if (isset($_POST['email']))  $email = $_POST['email'];

        else $email = $_GET['email'];

        if (check_email($email)) {

            fill_reset_values($email, $reset_code);
            send_Reset_email($email, $reset_code);
            echo '<div style="width:min-width; padding: 6px; text-align:center; background-color:#0e171e ;color:white ; position:relative;" class="alert">Email envoyé avec succès.</div>';
        } else echo '<div style="width:min-width; padding: 6px; text-align:center; background-color:#0e171e ;color:white ; position:relative;" class="alert">Email incorrect.</div>';
    }
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
