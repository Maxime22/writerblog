<h2>Ajouter un commentaire</h2>
<form action="" method="post">
  <p>
    <?=isset($errors) && in_array(\Entity\Comment::AUTHOR_NOTVALID, $errors) ? 'L\'auteur est invalide.<br />' : ''?>
    <label>Pseudo</label>
    <input type="text" name="author" value="<?=isset($comment) ? htmlspecialchars($comment['author']) : ''?>" /><br />

    <?=isset($errors) && in_array(\Entity\Comment::CONTENT_INVALID, $errors) ? 'Le contenu est invalide.<br />' : ''?>
    <label>Contenu</label>
    <textarea name="content" rows="7" cols="50"><?=isset($comment) ? htmlspecialchars($comment['content']) : ''?></textarea><br />

    <input type="submit" value="Commenter" />
  </p>
</form>