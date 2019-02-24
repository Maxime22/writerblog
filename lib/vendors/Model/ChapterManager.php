<?php
namespace Model;

use \MiniFram\Manager;
use \Entity\Chapter;

abstract class ChapterManager extends Manager
{
  /**
   * Return number of chapters asked by the controller
   * @param $start int is the first chapter to select
   * @param $limit int is the number of chapters to select
   * @return array La liste des news. Chaque entrée est une instance de News.
   */
  abstract public function getList($start = -1, $limit = -1);

  /**
   * Return a specific chapter
   * @param $id int = ID of the chapter
   * @return Chapter Return the Chapter
   */
  abstract public function getUnique($id);

  /**
   * Returns the total number of chapters
   * @return int
   */
  abstract public function count();

  /**
   * Add a chapter
   * @param $chapter Chapter to add
   * @return void
   */
  abstract protected function add(Chapter $chapter);
  
  /**
   * Save a chapter (add or update(modify))
   * @param $chapter
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Chapter $chapter)
  {
    if ($chapter->isValid())
    {
      $chapter->isNew() ? $this->add($chapter) : $this->modify($chapter);
    }
    else
    {
      throw new \RuntimeException('Le chapitre doit être validé pour être enregistré');
    }
  }
}