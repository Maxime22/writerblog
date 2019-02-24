<form action="" method="post">
  <p>
    <?=isset($errors) && in_array(\Entity\Chapter::AUTHOR_NOTVALID, $errors) ? 'L\'auteur est invalide.<br />' : ''?>
    <label>Auteur</label>
    <input type="text" name="author" value="<?=isset($chapter) ? $chapter['author'] : ''?>" /><br />

    <?=isset($errors) && in_array(\Entity\Chapter::TITLE_INVALID, $errors) ? 'Le titre est invalide.<br />' : ''?>
    <label>Titre</label><input type="text" name="title" value="<?=isset($chapter) ? $chapter['title'] : ''?>" /><br />

    <?=isset($errors) && in_array(\Entity\Chapter::CONTENT_INVALID, $errors) ? 'Le contenu est invalide.<br />' : ''?>
    <label>Contenu</label><textarea rows="8" cols="60" name="content"><?=isset($chapter) ? $chapter['content'] : ''?></textarea><br />
<?php
if (isset($chapter) && !$chapter->isNew()) {
    ?>
    <input type="hidden" name="id" value="<?=$chapter['id']?>" />
    <input type="submit" value="Modifier" name="modify" />
<?php
} else {
    ?>
    <input type="submit" value="Ajouter" />
<?php
}
?>
  </p>
</form>