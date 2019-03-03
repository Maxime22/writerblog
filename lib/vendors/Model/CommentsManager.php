<?php
namespace Model;

use \Entity\Comment;
use \MiniFram\Manager;

abstract class CommentsManager extends Manager
{
    /**
     * Add a comment
     * @param $comment Comment to add
     * @return void
     */
    abstract protected function add(Comment $comment);

    /**
     * Save a comment
     * @param $comment Comment to save
     * @return void
     */
    public function save(Comment $comment)
    {
        if ($comment->isValid()) {
            $comment->isNew() ? $this->add($comment) : $this->modify($comment);
        } else {
            throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
        }
    }

    /**
     * Catch a list of comments
     * @param $chapter Chapter where we want the comments
     * @return array
     */
    abstract public function getListOf($chapter);

    /**
     * Modify a comment
     * @param $comment Comment to be mmodified
     * @return void
     */
    abstract protected function modify(Comment $comment);

    /**
     * Get a specify comment
     * @param $id Id of the comment
     * @return Comment
     */
    abstract public function get($id);

    /**
     * Delete a comment
     * @param $id Id of the comment to delete
     * @return void
     */
    abstract public function delete($id);

    /**
     * Delete all the news linked to a chapter
     * @param $chapter Id of the chapter where all the comments need to be deleted
     * @return void
     */
    abstract public function deleteFromChapter($chapter);
}
