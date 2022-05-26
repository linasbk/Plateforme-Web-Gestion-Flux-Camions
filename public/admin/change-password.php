<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Admin', 'js' => 'vehicule']) ?>


<script type="text/javascript">
    function checkpass() {
        if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
            alert('New Password and Confirm Password field does not match');
            document.changepassword.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>


<div class="main">
    <?php view('sidebar') ?>


    <titre>
        <strong>Changer </strong> mot de passe
    </titre>


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


    </form>
    <a href="admin-profile.php"><button><i></i>Modifier donnée</button></a>


</div>
<?php view('footer') ?>