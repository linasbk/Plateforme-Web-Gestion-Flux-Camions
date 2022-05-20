<?php
#needs reimplemintation
?>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

<nav class="aside close">
    <header class="header">
        <div class="image-text">
            <span class="image">
                <img src="/vpms/images/logo.png" alt="">
            </span>

            <div class="text logo-text">
                <span class="name">Système de </span>
                <span class="profession">gestion des véhicules</span>
                Welcome <?= current_user() ?>
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            <ul class="menu-links">

                <li class="nav-link">
                    <a href="dashboard.php" id="button">
                        <i class='bx bx-home-alt icon'></i>
                        <span class="text nav-text">Tableau de bord</span>
                    </a>
                </li>

                <li>
                    <a href="gerer-vehicule.php"> <i class='bx bxs-truck icon'></i>
                        <span class="text nav-text">Gérer véhicules</span>
                    </a>
                </li>

                <li>
                    <a href="gerer-personne.php"> <i class='bx bxs-user-plus icon'></i>
                        <span class="text nav-text">Gérer conducteurs</span>
                    </a>
                </li>


                <li>
                    <a href="gerer-association.php"> <i class='bx bxs-analyse icon'></i>
                        <span class="text nav-text">Gérer les permits </span>
                    </a>
                </li>


                <li>
                    <a href="gerer-users.php"> <i class='bx bxs-user icon'></i>
                        <span class="text nav-text">Gérer les utilisateur </span>
                    </a>
                </li>


                <li>
                    <a href="bwdates-report-ds.php"> <i class='bx bxs-report icon'></i>
                        <span class="text nav-text"> Rapports</span>
                    </a>
                </li>

                <li>
                    <a href="search-vehicule.php"> <i class='bx bx-search icon'></i>
                        <span class="text nav-text"> Rechercher un véhicule</span>
                    </a>
                </li>

            </ul>
        </div>
        <div class="bottom-content">
            <li class="">
                <a href="logout.php">
                    <i class='bx bx-log-out icon'></i>
                    <span class="text nav-text">
                        <p>Déconnexion</p>
                    </span>
                </a>
            </li>


        </div>
    </div>

</nav>

<script>
    const body = document.querySelector('body'),
        aside = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        searchBtn = body.querySelector(".search-box"),
        modeText = body.querySelector(".mode-text");

    toggle.addEventListener("click", () => {
        aside.classList.toggle("close");
    })
    searchBtn.addEventListener("click", () => {
        aside.classList.remove("close");
    })

    ;
</script>