<?php if ($user->hasFlash()) {echo '<div class="alert alert-primary row">', $user->getFlash(), '</div>';}?>
<div class="container chapterDivAll">
  <div id="contentAndChapter" class="col-12"> <!-- not displayed -->
    <h2><?=htmlspecialchars($chapter['title'])?></h2>
    <div id="contentDiv" class="chapterDiv">
    <p><?=$chapter['content']?></p>
    </div>
  </div>
  <div class="col-12 containerBook">
    <div id="flipbook">
	    <div class="hard cover"><div class="titleChapterBook"><?=htmlentities($chapter['title'])?></div></div>
	    <div id="firstPage" class="page"><div class="insidePage"></div></div>
    </div>
    <div class="dateAuthorChapter"><p>Par <em><?=$chapter['author']?></em>, le <?=$chapter['addDate']->format('d/m/Y à H\hi')?></p></div>
  </div>
</div>

<div class="container containerComments">
  <?php if ($chapter['addDate'] != $chapter['modifDate']) {?>
  <p style="text-align: right;"><small><em>Modifiée le <?=$chapter['modifDate']->format('d/m/Y à H\hi')?></em></small></p>
  <?php }?>

<?php if (!empty($comments)){ ?>
<h2 class="commentsTitleDisplay">Les commentaires</h2>
<div class="row ">
<div class="col-12">
<table class="tableComments table table-striped">
  <tr><th>Auteur</th><th>Date d'ajout</th><th>Contenu</th>
  <?php if ($user->isAuthenticated()) {?>
  <th>Action</th>
  <?php }?>
  <th>Signalement</th></tr>
<?php
foreach ($comments as $comment) {
    echo '<tr><td>', htmlspecialchars($comment['author']), '</td>
        <td>le ', $comment['date']->format('d/m/Y à H\hi'), '</td>
        <td>', nl2br(htmlspecialchars($comment['content'])), '</td>';
    ?>
        <?php if ($user->isAuthenticated()) {?>
          <td>
        <a href="admin/comment-update-<?=$comment['id']?>-from-chapter-<?=$comment['chapter']?>"><i class="fas fa-pen"></i></a>
        <a href="admin/comment-delete-<?=$comment['id']?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer cette entrée ?'));"><i class="far fa-trash-alt"></i></a>
        </td>
        <?php }?>
      <td>
      <?php if ($comment->reporting() == 0 || $comment->reporting() == null) {?>
        <a href="comment-report-<?=$comment['id']?>"><i class="far fa-flag"></i></a>
      <?php } else {?>
      <span>Commentaire déjà signalé</span>
      <?php }?>
      </td></tr>
<?php
}
?>
</table>
</div>
</div>
<?php
} else {
    ?>
  <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
  <?php
}
?>
<p class="addCommentToChapter"><a href="comment-<?=$chapter['id']?>"><strong>Ajouter un commentaire</strong></a></p>
</div>

<div class=container>
<div class="containLoader"></div>
<div class="loader"></div>
<p><a href="/chapters">Revenir aux chapitres</a></p>
</div>

<script type="text/javascript">
$(window).on('load', function() {

  $(".containLoader").fadeOut(4000);
  $(".loader").fadeOut(500);
})
</script>
<script src="/js/book.js"></script>
<script src="/js/turn.js"></script>
<script src="/js/bookLogic.js"></script>

