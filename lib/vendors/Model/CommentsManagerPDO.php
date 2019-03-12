<?php
namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{
    protected function add(Comment $comment)
    {
        $q = $this->dao->prepare('INSERT INTO comments SET chapter = :chapter, author = :author, content = :content, date = NOW()');

        $q->bindValue(':chapter', $comment->chapter(), \PDO::PARAM_INT);
        $q->bindValue(':author', $comment->author());
        $q->bindValue(':content', $comment->content());

        $q->execute();

        $comment->setId($this->dao->lastInsertId());
    }

    public function getListOf($chapter)
    {
        if (!ctype_digit($chapter)) {
            throw new \InvalidArgumentException('L\'identifiant du chapitre passé doit être un nombre entier valide');
        }

        $q = $this->dao->prepare('SELECT id, chapter, author, content, date, reporting, reportingDate FROM comments WHERE chapter = :chapter ORDER BY date DESC');
        $q->bindValue(':chapter', $chapter, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $comments = $q->fetchAll();

        foreach ($comments as $comment) {
            $comment->setDate(new \DateTime($comment->date()));
        }

        return $comments;
    }

    protected function modify(Comment $comment)
    {
        $q = $this->dao->prepare('UPDATE comments SET author = :author, content = :content WHERE id = :id');

        $q->bindValue(':author', $comment->author());
        $q->bindValue(':content', $comment->content());
        $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

        $q->execute();
    }

    public function get($id)
    {
        $q = $this->dao->prepare('SELECT id, chapter, author, content FROM comments WHERE id = :id');
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        return $q->fetch();
    }

    public function delete($id)
    {
        $this->dao->exec('DELETE FROM comments WHERE id = ' . (int) $id);
    }

    public function deleteFromChapter($chapter){
        $this->dao->exec('DELETE FROM comments WHERE chapter = ' . (int) $chapter);
    }

    public function report($id){
        $q = $this->dao->prepare('UPDATE comments SET reporting = 1, reportingDate = NOW() WHERE id = :id');
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();
    }

    public function unreport($id){
        $q = $this->dao->prepare('UPDATE comments SET reporting = 0, reportingDate = null WHERE id = :id');
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();
    }

    public function getListOfReportedComments(){
        $q = $this->dao->prepare('SELECT id, chapter, author, content, date, reporting, reportingDate FROM comments WHERE reporting = 1');
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $commentsReported = $q->fetchAll();

        foreach ($commentsReported as $comment) {
            $comment->setDate(new \DateTime($comment->date()));
            $comment->setReportingDate(new \DateTime($comment->reportingDate()));
        }

        return $commentsReported;
    }
}
