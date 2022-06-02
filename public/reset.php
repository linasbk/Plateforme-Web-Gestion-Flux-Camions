<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/checkreset.php';
?>

<?php view('header', ['title' => 'Réinitialiser votre mot de passe', 'css' => 'register']) ?>

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

<div class="indexbody">

    <div class="login-wrapper">
        <div action="" class="form-contenue register">
            <h1 style="text-align:center;">Réinitialiser votre mot de passe</h1>
            <div class="card-body" id="formContainer">

                <div class="Form" id="loginForm">

                    <form action="" method="post" enctype="multipart/form-data" name="changepassword" onsubmit="return checkpass();">



                        <div class="input-group">
                            <input type="password" name="newpassword" id="newpassword" required>
                            <label for="newpassword">nouveau mot de passe</label>

                        </div>

                        <div class="input-group">
                            <input type="password" name="confirmpassword" id="confirmpassword" required>
                            <label for="confirmpassword">Confirmez le mot de passe</label>

                        </div>

                        <small class="info-red" id='info-error'></small>
                        <button name="submit" type="submit" class="submit-btn">Réinitialiser</button>


                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<?php view('footer') ?>