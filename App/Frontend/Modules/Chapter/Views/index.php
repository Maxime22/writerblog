<div class="row">
<figure class="figure100">
  <img id="imgMountain" src="/images/mountain.jpg" alt="Image Montagne" title="Montagne"/>
  <figcaption class="figcaptionMountain">
    <h1>Chapitres<h1>
    </figcaption>
</figure>
<div class="container">
<?php 
$cpt = 0;
if (!empty($listChapters)) {
foreach ($listChapters as $chapter) {
  $cpt++;
  ?>
<div class="row containChapter">
  <div class="col-2">
  <a class="linkLittleBookChapters" href="/chapter-<?php echo $chapter['id'] ?>">
  <div class="littleBookChapters">
  <h2><?php echo 'Chapitre n°',$cpt,'<br><br>',htmlspecialchars($chapter['title']) ?></h2>
</div>
</a>
</div>
<div class="col-10">
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
  <span>Aucun chapitre n'a été publié pour le moment... soyez patient, il n'y en a plus pour longtemps !</span>
<?php
}
?>
</div>
</div>