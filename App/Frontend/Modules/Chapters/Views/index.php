<?php
foreach ($listChapters as $chapter) {
    ?>
  <h2><a href="news-<?=$chapter['id']?>.html"><?=$chapter['titre']?></a></h2>
  <p><?=nl2br($chapter['contenu'])?></p>
<?php
}