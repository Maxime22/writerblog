<div class="container">
  <div id="contentAndChapter" class="col-12">
    <h2><?=$chapter['title']?></h2>
    <div id="contentDiv" class="chapterDiv">
    <p><?=nl2br($chapter['content'])?></p>
    </div>
  </div>
  <div class="col-12 containerBook">
    <div id="flipbook">
	    <div class="hard cover"><?=$chapter['title']?></div>
	    <div id="firstPage" class="page"><div class="insidePage"></div></div>
    </div>
    <div class="dateAuthorChapter"><p>Par <em><?=$chapter['author']?></em>, le <?=$chapter['addDate']->format('d/m/Y à H\hi')?></p></div>
  </div>

</div>

<div class="container">
  <?php if ($chapter['addDate'] != $chapter['modifDate']) {?>
  <p style="text-align: right;"><small><em>Modifiée le <?=$chapter['modifDate']->format('d/m/Y à H\hi')?></em></small></p>
  <?php }?>

  <?php
  if (empty($comments)) {
      ?>
  <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
  <?php
  }

  foreach ($comments as $comment) {
      ?>
    <fieldset>
    <?php if ($user->isAuthenticated()) {?> -
        <a href="admin/comment-update-<?=$comment['id']?>-from-chapter-<?=$comment['chapter']?>">Modifier</a> |
        <a href="admin/comment-delete-<?=$comment['id']?>">Supprimer</a>
      <?php }?>
      <?php if ($comment->reporting() == 0 || $comment->reporting() == null) {?> -
        <a href="admin/comment-report-<?=$comment['id']?>">Signaler</a>
      <?php } else {?>
      <span>Ce commentaire a été signalé</span>
      <?php }?>
      <legend>
        Posté par <strong><?=htmlspecialchars($comment['author'])?></strong> le <?=$comment['date']->format('d/m/Y à H\hi')?>
      </legend>
      <p><?=nl2br(htmlspecialchars($comment['content']))?></p>
    </fieldset>
  <?php
  }
  ?>

  <p><a href="comment-<?=$chapter['id']?>">Ajouter un commentaire</a></p>
  <p><a href="/chapters">Revenir aux chapitres</a></p>
</div>

<script src="/js/book.js"></script>
<script src="/js/turn.js"></script>
<script src="/js/bookLogic.js"></script>

