<div class="searchbar">
    <form class="search" action="" method="post" enctype="multipart/form-data" name="search" id="formsearch">

        <li class="searchli"><button type="submit" class="searchbutton1 searchcon" onclick="hidetab()" name="search"><i class='bx bx-search icon searchicon'> </i></button>

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


    </form>
</div>

<?php
if (isset($_POST['search'])) {
    $_SESSION['searchtype'] =  $_POST['searchtype'];
    $_SESSION['searchdata'] = $_POST['searchdata'];
    header("Location: search-vehicule.php");
}
?>