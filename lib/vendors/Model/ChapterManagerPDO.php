<?php
namespace Model;

class ChapterManagerPDO extends ChapterManager
{
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, author, title, content, addDate, modifDate FROM chapter ORDER BY id DESC';

        if ($start != -1 || $limit != -1) {
            $sql .= ' LIMIT ' . (int) $limit . ' OFFSET ' . (int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');

        $listChapters = $request->fetchAll();

        foreach ($listChapters as $chapter) {
            $chapter->setAddDate(new \DateTime($chapter->addDate()));
            $chapter->setModifDate(new \DateTime($chapter->modifDate()));
        }

        $request->closeCursor();

        return $listChapters;
    }
}
