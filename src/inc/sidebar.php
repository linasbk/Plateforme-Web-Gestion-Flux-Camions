<?php
require __DIR__ . '/../../src/vehicule.php';
?>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


<nav class="aside ">
    <div class="header">
        <div class="image-text">
            <span class="image">
                <img src="../images/logo.png" alt="">
            </span>

            <div class="text logo-text">
                <span class="name">Système de </span>
                <span class="profession">gestion des véhicules</span>

            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>

    </div>


    <div class="menu-bar">
        <div class="menu">
            <div class="sidesearch">
                <?php view('searchbar') ?>
            </div>
            <ul class="menu-links">

                <li class="nav-link">
                    <a href="admin.php" id="button">
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
                    <a href="gerer-utilisateur.php"> <i class='bx bxs-user icon'></i>
                        <span class="text nav-text">Gérer utilisateur <?php if (!is_user_read_admin() && users_exist_innaproved() > 0)
                                                                            echo '<approved>' . users_exist_innaproved() . '</approved>'; ?></span>
                    </a>
                </li>


                <li>
                    <a href="upload-images.php"> <i class='bx bxs-report icon'></i>
                        <span class="text nav-text">Reconnaissance </span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="bottom-content">

            <li class="">
                <a href="../logout.php">
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
        searchicon = body.querySelector(".searchicon"),
        modeText = body.querySelector(".mode-text");

    toggle.addEventListener("click", () => {
        aside.classList.toggle("close");

    });
    searchicon.addEventListener("click", () => {
        aside.classList.remove("close");
    });
</script>


<script>
    window.addEventListener('scroll', function() {
        let header = document.querySelector('.navheader');
        let windowPosition = window.scrollY > 0;
        header.classList.toggle('scrolling-active', windowPosition);
    })
</script>


<div class="background">
    <header id="navheader" class="navheader ">
        <!-- logo -->

        <titre>
            <strong><?= $titre ?? 'Dashboard' ?></strong>
        </titre>

        <div class="utilisateur">

            <!-- utilisateur icon -->

            <a href="change-password.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <object data="/public/images/images.png" width="60" height="65"> </object></a>


        </div>

    </header>
    <div class="contenue">