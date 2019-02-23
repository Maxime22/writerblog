<p>Par <em><?=$chapter['author']?></em>, le <?=$chapter['addDate']->format('d/m/Y à H\hi')?></p>
<h2><?=$chapter['title']?></h2>
<p><?=nl2br($chapter['content'])?></p>

<?php if ($chapter['addDate'] != $chapter['modifDate']) {?>
<p style="text-align: right;"><small><em>Modifiée le <?=$chapter['modifDate']->format('d/m/Y à H\hi')?></em></small></p>
<?php }?>