<h1>Chapitres</h1>
<?php if (!empty($listChapters)){ ?>
<table class="tableChapters">
  <tr><th>Titre</th><th>Lecture</th></tr>
<?php
foreach ($listChapters as $chapter) {
    echo '<tr><td>', htmlspecialchars($chapter['title']), '</td><td><a href="/chapter-', $chapter['id'], '">Lire</a></td></tr>', "\n";
}
?>
</table>
<?php }else{ ?>
  <span>Aucun chapitre n'a été publié pour le moment... soyez patient, il n'y en a plus pour longtemps !</span>
<?php
}