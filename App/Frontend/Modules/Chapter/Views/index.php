<?php
foreach ($listChapters as $chapter) {
    ?>
  <h2><a href="chapter-<?=$chapter['id']?>.html"><?=$chapter['title']?></a></h2>
  <p><?=nl2br($chapter['content'])?></p>
<?php
}