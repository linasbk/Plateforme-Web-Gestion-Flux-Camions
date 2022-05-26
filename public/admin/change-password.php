<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
?>

<?php view('header', ['title' => 'Admin', 'js' => 'vehicule']) ?>


<script type="text/javascript">
    function checkpass() {
        if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
            alert('Les deux mot de passe ne correspond pas');
            document.changepassword.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>


<?php if (isset($_POST['submit'])) {

    $username = 'admin';
    $password = $_POST['confirmpassword'];
    $currentpassword = $_POST['currentpassword'];

    if (check_password($username, $currentpassword)) change_password($username, $password);
}
?>

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




</div>
<?php view('footer') ?>