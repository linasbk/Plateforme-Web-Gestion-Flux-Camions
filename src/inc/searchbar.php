<div class="searchbar">
    <form class="search" action="" method="post" enctype="multipart/form-data" name="search" id="formsearch">

        <li><a class="searchcon" href=""><i class='bx bx-search icon '></i>
            </a>
        </li>
        <input placeholder="Recherche" class="searchinput" type="text" id="searchdata" name="searchdata" required="required" autofocus="autofocus">
        <div>

            <select class="searchselect1" id="searchtype" name="searchtype">
                <option value="0">Accès</option>
                <option value="1">Matricule</option>
                <option value="2">Date</option>
                <option value="3">Heure</option>
                <option value="4">image</option>
                <option value="5">Sûreté</option>
            </select>
        </div>



        <button hidden type="submit" class="searchbutton1" onclick="hidetab()" name="search"></button>
    </form>
</div>

<?php
if (isset($_POST['search'])) {
    $_SESSION['searchtype'] =  $_POST['searchtype'];
    $_SESSION['searchdata'] = $_POST['searchdata'];
    header("Location: search-vehicule.php");
}
?>