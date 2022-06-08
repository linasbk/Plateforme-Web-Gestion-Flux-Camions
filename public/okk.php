<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();
redirect_admin();
?>

<?php view('header', ['title' => 'Dashboard']) ?>
<!doctype html>
<html lang="en">

<head>
  <title>Reservation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="css/user.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>
  <div>

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body">
        <ul class="site-nav-wrap">
          <li class="active"><a href="index.html" class="nav-link">Home</a></li>
          <li><a href="#" class="nav-link">Rendez-vous</a></li>
          <li><a href="#" class="nav-link">Compte</a></li>
          <li><a href="#" class="nav-link">Contactez-nous</a></li>
        </ul>
      </div>
    </div>



    <header class="site-navbar site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center position-relative">

          <div class="col-9 text-right text-lg-left">

            <span class="d-inline-block d-lg-none"><a href="#" class=" site-menu-toggle js-menu-toggle py-5 "><span class="icon-menu h3 text-white"></span></a></span>

            <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
              <ul class="nav">
                <li><a id="len1" class="hoverable" href="#">Home</a></li>
                <li><a id="len2" class="hoverable" href="##">Rendez-vous</a></li>
                <li><a id="len3" class="hoverable" href="#">Compte</a></li>
                <li><a id="len4" class="hoverable" href="#">Contact</a></li>
              </ul>
            </nav>
          </div>


        </div>
      </div>

    </header>


    <div class="hero overlay" style="background-image: url('images/background1.jpeg');">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-12">

            <div class="row align-items-center justify-content-between">

              <div class="col-lg-5 intro">
                <h1 class="text-white"><strong>Bonjour <?= current_user() ?> </strong></h1>
                <p class="text-white">Vous avez 30min pour la charge et decharge</p>
                </span>
                <audio src="audio.mp3" id="audio" controls style="display: none;"></audio>
                <button type="button" id="alarm" onclick="playaud();">ALARME</button>
                <script>
                  function playaud() {
                    document.getElementById("audio").play();

                  }
                </script>
              </div>

              <div class="col-lg-5">
                <form class="book-form">
                  <h3>Prenez Rendez-Vous</h3>
                  <div class="row align-items-center">
                    <div class="mb-3 mb-md-4 col-md-12">
                      <input type="text" class="form-control" placeholder="Nom">
                    </div>
                    <div class="mb-3 mb-md-4 col-md-12">
                      <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="mb-3 mb-md-4 col-md-12">
                      <div class="form-control-wrap">
                        <input type="text" id="cf-4" placeholder="Sélectionnez date" class="form-control datepicker px-3">
                        <span class="icon icon-date_range"></span>
                      </div>
                    </div>
                    <div class="mb-3 mb-md-4 col-md-12">
                      <div class="form-control-wrap">
                        <p>Conformité</p>
                        <label class="radio">
                          <input type="radio" id="1" name="Conformite">
                          <span></span> 1
                        </label>
                        <label class="radio">
                          <input type="radio" id="2" name="Conformite">
                          <span></span> 2
                        </label>
                        <label class="radio">
                          <input type="radio" id="3" name="Conformite">
                          <span></span> 3
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <input type="submit" value="Reservation" class="btn btn-primary btn-block py-3">
                    </div>
                  </div>
                </form>

              </div>
            </div>


          </div>
        </div>
      </div>
    </div>



    <div class="site-section bg-light">
      <div class="container">
        <div class="mb-5 text-center">
          <h2 class="section-heading"><strong class="text-black">Camions</strong> statut</h2>
          <p class="mb-5">Camions entrants et sortants</p>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-5">

            <div class="practicing">
              <div class="practicing-inner">
                <div class="wrap-icon">
                  <img class="truck-icon" src="truck.png" alt="">
                </div>
                <h3>13 </h3>
                <p>Nombres camions sortants</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-5">
            <div class="practicing">
              <div class="practicing-inner">
                <div class="wrap-icon">
                  <img class="truck-icon" src="truck.png" alt="">
                </div>
                <h3>22</h3>
                <p>Nombres camions entrants</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-5">
            <div class="practicing">
              <div class="practicing-inner">
                <div class="wrap-icon">
                  <img class="truck-icon" src="truck.png" alt="">
                </div>
                <h3>35</h3>
                <p>Nombres camions total </p>
              </div>
            </div>
          </div>




          <section class="bg-image" style="background-image:url('images/background1.jpeg'); width:100%">
            <section class="section ">
              <table>
                <tr>
                  <th class="left">
                    <div class="contact-us">Contacter-nous</div>
                    <div class="contact-address">
                      <p>CASABLANCA Road, DE 19808, MAROC </p>
                      <p class="phone">Phone : <span>(+212 523 006 700)</span></p>
                      <p class="email">E-mail : <span>(innovatel@gmail.com)</span></p>
                    </div>
                    <ul class="list-unstyled social">
                      <li><a href="#"><span class="icon-facebook"></span></a></li>
                      <li><a href="#"><span class="icon-instagram"></span></a></li>
                      <li><a href="#"><span class="icon-web"></span></a></li>
                      <li><a href="#"><span class="icon-linkedin"></span></a></li>
                    </ul>
                  </th>
                  <th class="right">
                    <div class="box">
                      <div class="contain">
                        <div class="dbl-field">
                        </div>



                        <form method="post" action="message.php" class="contact-form">
                          <div class="dbl-field">
                            <div class="field">

                              <input type="text" name="name" id="name" placeholder="Entrer ton nom" required>
                              <i class='fas fa-user'></i>
                            </div>
                          </div>
                          <div class="dbl-field">
                            <div class="field">
                              <input type="text" name="email" id="email" placeholder="Entrer ton email" required>
                              <i class='fas fa-envelope'></i>
                            </div>
                          </div>

                          <div class="message">
                            <textarea placeholder="Entrer ton message" name="message" id="message" required></textarea>
                            <i class="material-icons">message</i>
                          </div>
                          <div class="button-area">
                            <button type="submit" id="submit" name="submit">Envoyer Message</button>
                            <span></span>
                          </div>
                        </form>
                      </div>

                    </div>
                  </th>
                </tr>
              </table>
            </section>
            <footer class="site-footer">
              <div class="border-top pt-5">
                <center>
                  <p><strong>
                      Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                      </script> système de gestion des transports | Innovatel <a href="logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">
                          Déconnexion
                        </span>
                      </a>
                    </strong></p>
                </center>
              </div>
            </footer>
          </section>
          <script src="js/jquery-3.3.1.min.js"></script>
          <script src="js/popper.min.js"></script>
          <script src="js/bootstrap.min.js"></script>
          <script src="js/owl.carousel.min.js"></script>
          <script src="js/jquery.sticky.js"></script>
          <script src="js/jquery.waypoints.min.js"></script>
          <script src="js/jquery.animateNumber.min.js"></script>
          <script src="js/jquery.fancybox.min.js"></script>
          <script src="js/jquery.easing.1.3.js"></script>
          <script src="js/aos.js"></script>

          <script src="js/main.js"></script>

</body>

</html>