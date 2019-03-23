<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      <?=isset($title) ? $title : 'Jean Forteroche'?>
    </title>
    <link rel="icon" href="/images/favicon.png">
    <meta name="title" content="Jean Forteroche : Billet simple pour l'Alaska">
    <meta name="description"
        content="Jean Forteroche présente son livre : 'Billet simple pour l'Alaska' sous formes de... billets. Ces différents billets
        sont en réalité les différents chapitres d'une épopée captivante. L'auteur nous emmène dans les contrées lointaines de ses voyages et de ses souvenirs,
        n'hésitez donc pas à dévorer les billet les uns après les autres !">
    <meta name="keywords" content="book, Alaska, chapters, Jean Forteroche">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css" type="text/css" >
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
</head>

  <body> <!-- oncontextmenu="return false;" -->
    <div>
    <header class="container-fluid">
            <nav class="navbar fixed-top navbar-expand-sm">
                <a class="navbar-brand" href="/"><img src="/images/logoJF.png" alt="Logo JF"
                        id="imgLogo" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="barsMenu"><i
                            class="fas fa-bars fa-2x"></i></span></button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="/chapters">Chapitres</a></li>
                        <?php if ($user->isAuthenticated()) {?>
                        <li class="nav-item"><a class="nav-link" href="/admin/">Admin</a></li>
                        <li class="nav-item lastNavItem"><a class="nav-link" href="/admin/deconnexion">Déconnexion</a></li>
                        <?php } else {?>
                            <li class="nav-item lastNavItem"><a class="nav-link" href="/admin/">Connexion</a></li>
                        <?php }?>
                    </ul>
                </div>
            </nav>
    </header>

    <section id="sectionContentFront" class="container-fluid">
        <?=$content?>
    </section>


    <footer class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 divFooter">
                        <div>
                            <h3>À propos :</h3>
                        </div>
                        <div class="line2"></div>
                        <a href="/about">L'auteur</a>
                    </div>
                    <div class="col-lg-4 col-md-6 divFooter">
                        <div>
                            <h3>Administration :</h3>
                        </div>
                        <div class="line2"></div>
                        <?php if ($user->isAuthenticated()) {?>
                            <a href="/admin/deconnexion">Déconnexion</a>
                        <?php } else {?>
                            <a href="/admin/">Connexion</a>
                        <?php }?>
                    </div>
                    <div class="col-lg-4 col-md-6 divFooter">
                        <div>
                            <h3>Retour à l'accueil :</h3>
                        </div>
                        <div class="line2"></div>
                        <a href="/">
                            <img src="/images/logoJF.png" class="logoFooter" alt="logoJF">
                        </a>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- Bootstrap -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
    <script>
        document.onkeydown=alert_keycode
        function alert_keycode(){if (event.keyCode == 17 || event.keyCode == 18) { console.log("On ne copie pas s'il vous plait !") }}
    </script>
  </body>
</html>