<?php
namespace App\Frontend\Modules\Chapter;

use \MiniFram\BackController;
use \MiniFram\HTTPRequest;

class ChapterController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $nbChapters = $this->app->config()->get('nb_chapters');
        $nbOfStrings = $this->app->config()->get('nb_strings');

        // We add a definition for the title
        $this->page->addVar('title', 'A ' . $nbChapters . ' chapitres');

        // We take the manager of Chapters
        $manager = $this->managers->getManagerOf('Chapter');

        // Call the number of chapters we want in the DB
        $listChapters = $manager->getList(0, $nbChapters);

        foreach ($listChapters as $chapter) { // show the 200 first letters of the chapter as a description
            if (strlen($chapter->content()) > $nbOfStrings) {
                $start = substr($chapter->contenu(), 0, $nbOfStrings);
                $start = substr($start, 0, strrpos($start, ' ')) . '...';

                $chapter->setContent($start);
            }
        }

        // We add the variable $listeChapter to the view (which will be read in a list (ArrayAccess))
        $this->page->addVar('listChapters', $listChapters);
    }

    public function executeShow(HTTPRequest $request)
    {
        $chapter = $this->managers->getManagerOf('Chapter')->getUnique($request->getData('id'));

        if (empty($chapter)) {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVar('title', $chapter->title());
        $this->page->addVar('chapter', $chapter);
    }

}
