<?php
namespace Model;

use \Entity\Chapter;

class ChapterManagerPDO extends ChapterManager
{
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, author, title, content, addDate, modifDate FROM chapter ORDER BY addDate';

        if ($start != -1 || $limit != -1) {
            $sql .= ' LIMIT ' . (int) $limit . ' OFFSET ' . (int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');
        // FETCH_CLASS returns a new instance of the class from the DB, it links the data columns to the name of the class attributes
        // class constructor is called before that the properties are assigned based on the values for each column before we added FETCH_PROPS_LATE

        $listChapters = $request->fetchAll();

        foreach ($listChapters as $chapter) {
            $chapter->setAddDate(new \DateTime($chapter->addDate()));
            $chapter->setModifDate(new \DateTime($chapter->modifDate()));
        }

        $request->closeCursor();

        return $listChapters;
    }

    public function getUnique($id)
    {
        $request = $this->dao->prepare('SELECT * FROM chapter WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');

        if ($chapter = $request->fetch()) {
            $chapter->setAddDate(new \DateTime($chapter->addDate()));
            $chapter->setModifDate(new \DateTime($chapter->modifDate()));
            return $chapter;
        }

        return null;

    }

    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM chapter')->fetchColumn();
    }

    protected function add(Chapter $chapter)
    {
        $request = $this->dao->prepare('INSERT INTO chapter SET author = :author, title = :title, content = :content, addDate = NOW(), modifDate = NOW()');

        $request->bindValue(':title', $chapter->title());
        $request->bindValue(':author', $chapter->author());
        $request->bindValue(':content', $chapter->content());

        $request->execute();
    }

    protected function modify(Chapter $chapter)
    {
        $request = $this->dao->prepare('UPDATE chapter SET author = :author, title = :title, content = :content, modifDate = NOW() WHERE id = :id');

        $request->bindValue(':title', $chapter->title());
        $request->bindValue(':author', $chapter->author());
        $request->bindValue(':content', $chapter->content());
        $request->bindValue(':id', $chapter->id(), \PDO::PARAM_INT);

        $request->execute();
    }

    public function delete($id)
    {
        $this->dao->exec('DELETE FROM chapter WHERE id = ' . (int) $id);
    }
}
