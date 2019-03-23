<div class="row">
  <figure class="figure100">
    <img id="imgMountain" src="/images/mountain.jpg" alt="Image Montagne" title="Montagne"/>
    <figcaption class="figcaptionMountain">
      <h1>Chapitres</h1>
    </figcaption>
  </figure>
</div>
<?php if ($user->hasFlash()) {echo '<div class="alert alert-primary row">', $user->getFlash(), '</div>';}?>
<div class="container">
  <?php 
  $cpt = 0;
  if (!empty($listChapters)) {
  foreach ($listChapters as $chapter) {
  $cpt++;
  ?>
  <div class="row containChapter">
    <div class="col-lg-2 col-xs-12 miniBookChapter">
      <a class="linkLittleBookChapters" href="/chapter-<?php echo $chapter['id'] ?>">
        <div class="littleBookChapters">
          <h2><?php echo 'Chapitre n°',$cpt,'<br><br>',htmlspecialchars($chapter['title']) ?></h2>
        </div>
      </a>
    </div>
    <div class="col-lg-10 col-xs-12">
      <?php
        if (strlen($chapter->content()) > 1000) // if chapter->content() has too much letters, we modify it with substr()
        {
          $begin = substr($chapter->content(), 0, 1000);
          $begin = substr($begin, 0, strrpos($begin, ' ')) . '...';

        $chapter->setContent($begin);
        }
        echo '<div class="resumeChapters">', strip_tags($chapter['content']),' <a href="/chapter-',$chapter['id'],'"><br>Découvrir le chapitre...</a></div>';
      ?>
    </div>
  </div>
  <?php
  }
  } else {?>
    <p class="noChapters">Aucun chapitre n'a été publié pour le moment... soyez patient, il n'y en a plus pour longtemps !</p>
  <?php
  }
  ?>
</div>