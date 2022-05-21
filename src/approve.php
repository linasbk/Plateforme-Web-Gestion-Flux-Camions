<script>
    function hideMessage() {
        document.getElementById("connectMsg").style.display = "none"
    };
    setTimeout(hideMessage, 2000);
</script>
<?php

$inputs = [];
$errors = [];

if (is_post_request()) {


    if (isset($_POST['submit'])) {

        $id = $_POST['id'];
        toggle_approval($id);
        if (check_approval($id)) {
            echo "<p id='connectMsg' class='alert alert-success'>Compte deverrouillé </p>";
        } else {
            echo "<p id='connectMsg' class='alert alert-success'>Compte verrouillé</p>";
        }
    }
}
