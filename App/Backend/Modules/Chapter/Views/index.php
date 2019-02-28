<p style="text-align: center">Il y a actuellement <?=$numberOfChapters?> chapitres. En voici la liste :</p>

<table class="tableChapters">
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listChapters as $chapter) {
    echo '<tr><td>', $chapter['author'], '</td><td>', $chapter['title'],
    '</td><td>le ', $chapter['addDate']->format('d/m/Y à H\hi'), '</td><td>',
    ($chapter['addDate'] == $chapter['modifDate'] ? '-' : 'le ' . $chapter['modifDate']->format('d/m/Y à H\hi')),
    '</td><td><a href="chapter-update-',$chapter['id'],'"><i class="fas fa-pen"></i></a> <a href="chapter-delete-',
    $chapter['id'], '"><i class="fas fa-times"></i></a></td></tr>', "\n";
}
?>
</table>

<div><a href="/admin/chapter-insert">Ajouter un chapitre</a></div>
