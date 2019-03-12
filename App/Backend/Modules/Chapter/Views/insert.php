<div class="row">
  <figure class="figure100">
  <img id="imgNight" src="/images/night.jpg" alt="Image Nuit" title="Nuit"/>
  <figcaption class="figcaptionMountain">
    <h1>Ajout d'un chapitre<h1>
    </figcaption>
</figure>
</div>
<?php if ($user->hasFlash()) {echo '<div class="alert alert-primary row">', $user->getFlash(), '</div>';}?>
<form action="" method="post">
<div class="offset-2 col-8 commentFormDiv">
    <?=$form?>

    <input class="btn btn-primary" type="submit" value="Ajouter" />
</div>
</form>

<script src="/js/tinyMCE.js"></script>