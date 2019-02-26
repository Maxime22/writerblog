<p>Par <em><?=$chapter['author']?></em>, le <?=$chapter['addDate']->format('d/m/Y à H\hi')?></p>
<h2><?=$chapter['title']?></h2>
<p><?=nl2br($chapter['content'])?></p>

<?php if ($chapter['addDate'] != $chapter['modifDate']) {?>
<p style="text-align: right;"><small><em>Modifiée le <?=$chapter['modifDate']->format('d/m/Y à H\hi')?></em></small></p>
<?php }?>

<?php
if (empty($comments))
{
?>
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php
}

foreach ($comments as $comment)
{
?>
  <fieldset>
    <legend>
      Posté par <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['date']->format('d/m/Y à H\hi') ?>
    </legend>
    <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
  </fieldset>
<?php
}
?>

<p><a href="comment-<?= $chapter['id'] ?>">Ajouter un commentaire</a></p>