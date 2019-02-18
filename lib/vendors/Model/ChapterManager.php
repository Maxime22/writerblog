<?php
namespace Model;

use \MiniFram\Manager;

abstract class ChapterManager extends Manager
{
  /**
   * Méthode retournant une liste de news demandée
   * @param $start int is the first chapter to select
   * @param $limit int is the number of chapters to select
   * @return array La liste des news. Chaque entrée est une instance de News.
   */
  abstract public function getList($start = -1, $limit = -1);
}