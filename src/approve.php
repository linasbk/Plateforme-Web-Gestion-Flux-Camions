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
        approve_user($id);
        echo "<p id='connectMsg' class='alert alert-success'>utilisateur approuvé</p>";
    }
}
