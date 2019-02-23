<?php ?>
<div class="row">
<figure class="figure100">
  <img id="imgAlaska1" src="/images/alaska1.jpg" alt="Image Aurore Boreale Alaska" title="Aurore Boréale"/>
  <figcaption class="figcaptionAlaska1">
    <h1>Jean Forteroche<h1>
    <h2>Billet simple pour l'Alaska<h2>
    </figcaption>
</figure>
<div class="container">
<h3>Bienvenue à toi cher lecteur...</h3>
<?php
foreach ($listChapters as $chapter) {
    ?>
  <h2><a href="chapter-<?=$chapter['id']?>.html"><?=$chapter['title']?></a></h2>
  <p><?=nl2br($chapter['content'])?></p>
  <?php
}?>
</div>
</div>
