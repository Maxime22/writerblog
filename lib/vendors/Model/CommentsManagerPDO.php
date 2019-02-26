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

        $q = $this->dao->prepare('SELECT id, chapter, author, content, date FROM comments WHERE chapter = :chapter');
        $q->bindValue(':chapter', $chapter, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $comments = $q->fetchAll();

        foreach ($comments as $comment) {
            $comment->setDate(new \DateTime($comment->date()));
        }

        return $comments;
    }
}
