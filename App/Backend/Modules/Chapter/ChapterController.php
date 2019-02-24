<?php
namespace App\Backend\Modules\Chapter;

use \MiniFram\BackController;
use \MiniFram\HTTPRequest;

class ChapterController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des chapitres');

        $manager = $this->managers->getManagerOf('Chapter');

        $this->page->addVar('listChapters', $manager->getList());
        $this->page->addVar('numberOfChapters', $manager->count());
    }
}
