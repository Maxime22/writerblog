<form action="" method="post">
  <p>
    <?=isset($errors) && in_array(\Entity\Comment::AUTHOR_NOTVALID, $erreurs) ? 'L\'auteur est invalide.<br />' : ''?>
    <label>Pseudo</label><input type="text" name="pseudo" value="<?=htmlspecialchars($comment['author'])?>" /><br />

    <?=isset($erreurs) && in_array(\Entity\Comment::CONTENT_INVALID, $erreurs) ? 'Le contenu est invalide.<br />' : ''?>
    <label>Contenu</label><textarea name="content" rows="7" cols="50"><?=htmlspecialchars($comment['content'])?></textarea><br />

    <input type="hidden" name="chapter" value="<?=$comment['chapter']?>" />
    <input type="submit" value="Modifier" />
  </p>
</form>