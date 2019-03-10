<div class="row">
  <figure class="figure100">
  <img id="imgGreenLight" src="/images/greenLight.jpg" alt="Lumière verte" title="Lumière verte"/>
  <figcaption class="figcaptionGreenLight">
    <h1>Administration<h1>
    </figcaption>
</figure>
</div>

<div class="container containerAdmin">
<h2 class="titleAdminMainPage firstTitleAdminMainPage">Gestion des chapitres</h2>
<?php if (!empty($listChapters)) {
    ?>
<p style="text-align: center">Il y a actuellement <?=$numberOfChapters?> chapitre(s). En voici la liste :</p>
<div class="offset-2 col-8">
<table class="tableChapters table table-striped">
  <tr><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listChapters as $chapter) {
        echo '<tr><td>', htmlspecialchars($chapter['title']),
        '</td><td>le ', $chapter['addDate']->format('d/m/Y à H\hi'), '</td><td>',
        ($chapter['addDate'] == $chapter['modifDate'] ? '-' : 'le ' . $chapter['modifDate']->format('d/m/Y à H\hi')),
        '</td>
        <td>
        <a href="/chapter-', $chapter['id'], '"><i class="fas fa-book-open"></i></a>
        <a href="chapter-update-', $chapter['id'], '"><i class="fas fa-pen"></i></a>';?>
        <a href="chapter-delete-<?php echo $chapter['id'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer cette entrée ?'));"><i class="far fa-trash-alt"></i></a>
        </td></tr>
        <?php
}
    ?>
</table>
</div>

<?php } else {?>
<span>Aucun chapitre n'a encore été publié sur le site.</span>
<?php
}
?>
<div class="addChapterLink"><a href="/admin/chapter-insert">Ajouter un chapitre</a></div>

<h2 class="titleAdminMainPage">Gestion des commentaires signalés</h2>
<?php
if (!empty($listCommentsReported)) {?>

<div class="offset-2 col-8">
<table class="tableChapters table table-striped"">
  <tr><th>Auteur</th><th>Dernière date de modification</th><th>Commentaire</th><th>Date de signalement</th><th>Action</th></tr>
<?php
foreach ($listCommentsReported as $comment) {
    if (strlen($comment->content()) > 100) // if comments->content() has too much letters, we modify it with substr()
    {
        $begin = substr($comment->content(), 0, 100);
        $begin = substr($begin, 0, strrpos($begin, ' ')) . '...';

        $comment->setContent($begin);
    }
    echo '<tr><td>', htmlspecialchars($comment['author']), '</td><td>le ', $comment['date']->format('d/m/Y à H\hi'), '</td><td>', nl2br(htmlspecialchars($comment['content'])), '</td>
    <td>', $comment['reportingDate']->format('d/m/Y à H\hi'), '</td>
    <td>
    <a href="comment-update-', $comment['id'], '-from-chapter-', $comment['chapter'], '"><i class="fas fa-pen"></i></a>';?>
    <a href="comment-delete-<?php echo $comment['id'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer cette entrée ?'));"><i class="far fa-trash-alt"></i></a>
    <?php echo '<a href="comment-unreport-', $comment['id'], '"><i class="fas fa-check"></i></a></td></tr>';
}
    ?>
</table>
</div>

<?php } else {
    ?>
  <span>Aucun commentaire n'a été reporté pour le moment</span>
    <?php
}?>

</div>