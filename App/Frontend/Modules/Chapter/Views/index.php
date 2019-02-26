<table class="tableChapters">
  <tr><th>Titre</th><th>Lecture</th></tr>
<?php
foreach ($listChapters as $chapter) {
    echo '<tr><td>', $chapter['title'], '</td><td><a href="/chapter-', $chapter['id'], '">Lire</a></td></tr>', "\n";
}
?>
</table>