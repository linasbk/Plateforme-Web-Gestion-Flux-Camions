<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Admin', 'js' => 'vehicule']) ?>


<script type="text/javascript">
    function checkpass() {
        if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
            document.getElementById("info-error").innerHTML = 'Les deux mot de passe ne correspond pas';
            document.changepassword.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>




<div class="main">

    <?php view('sidebar', ['titre' => 'Changer mot de passe']) ?>


    <form action="" method="post" enctype="multipart/form-data" name="changepassword" onsubmit="return checkpass();">



        <div>
            <label for="text-input">Mot de passe actuel</label>
            <input type="password" name="currentpassword" required="true" value="">
        </div>

        <div>
            <label for="email-input">Nouveau mot de passe</label>
            <input type="password" name="newpassword" value="" required="true">
        </div>

        <div>
            <label for="password-input">Confirmez le mot de passe.</label>
            <input type="password" name="confirmpassword" value="" required="true">
        </div>


        <p class="centerbutton"><button type="submit" name="submit">Changer</button></p>

        <?php if (isset($_POST['submit'])) {

            $username = 'admin';
            $password = $_POST['confirmpassword'];
            $currentpassword = $_POST['currentpassword'];

            if (check_password($username, $currentpassword)) {
                change_password($username, $password);
                echo '<small class="info">Mot de passe changé avec succès.<small>';
            } else echo '<small class="info-red">Mot de passe actuel incorrect .<small>';
        }
        ?>
        <small class="info-red" id='info-error'></small>
    </form>




</div>
<?php view('footer') ?>