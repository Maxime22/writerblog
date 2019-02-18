<!DOCTYPE html>
<html lang="fr">

<html>
  <head>
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      <?=isset($title) ? $title : 'Jean Forteroche'?>
    </title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <meta name="title" content="SMF Vélos : La réservation en un clic !">
    <meta name="description"
        content="Jean Forteroche présente son livre : 'Billet simple pour l'Alaska' sous formes de... billets. Ces différents billets
        sont en réalité les différents chapitres d'une épopée captivante. L'auteur nous emmène dans les contrées lointaines de ses voyages et de ses souvenirs,
         n'hésitez donc pas à dévorer les billet les uns après les autres !">
    <meta name="keywords" content="book, Alaska, chapters, Jean Forteroche">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- normalize.css is included in bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
</head>

  <body>
    <div>
      <header>
        <h1><a href="/">Jean Forteroche</a></h1>
        <p>Comment ça, il n'y a presque rien ?</p>
      </header>

      <nav>
        <ul>
          <li><a href="/">Accueil</a></li>
          <?php if ($user->isAuthenticated()) {?>
          <li><a href="/admin/">Admin</a></li>
          <li><a href="/admin/news-insert.html">Ajouter un chapitre</a></li>
          <?php }?>
        </ul>
      </nav>

      <div>
        <section>
          <?php if ($user->hasFlash()) {echo '<p style="text-align: center;">', $user->getFlash(), '</p>';}?>
          <?=$content?>
        </section>
      </div>

      <footer></footer>
    </div>
  </body>
</html>