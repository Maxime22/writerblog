<div class="row">
  <figure class="figure100">
  <img id="imgMountain" src="/images/mountain.jpg" alt="Image Montagne" title="Montagne"/>
  <figcaption class="figcaptionMountain">
    <h1>Connexion</h1>
    </figcaption>
</figure>
</div>
<?php if ($user->hasFlash()) {echo '<div class="alert alert-primary row">', $user->getFlash(), '</div>';}?>
<div class="row">
<div class="offset-lg-4 col-lg-4 offset-sm-2 col-sm-8 connexionContainer">
<form action="" method="post">
<div class="form-group">
  <label for="inputPseudo" class="labelConnexion">Pseudo</label>
  <input type="text" id="inputPseudo" name="login" class="form-control" /><br />
  </div>
  <div class="form-group">
  <label for="inputPassword" class="labelConnexion">Mot de passe</label>
  <input type="password" id="inputPassword" name="password" class="form-control" /><br /><br />
  </div>
  <input type="submit" class="btn btn-primary" value="Connexion" />
</form>
</div>
</div>