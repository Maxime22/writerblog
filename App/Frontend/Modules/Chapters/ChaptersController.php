<?php
namespace App\Frontend\Modules\Chapters;

use \MiniFram\BackController;
use \MiniFram\HTTPRequest;

class ChaptersController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $nbChapters = $this->app->config()->get('nb_chapters');
        $nbOfStrings = $this->app->config()->get('nb_strings');

        // We add a definition for the title
        $this->page->addVar('title', 'Liste des ' . $nbChapters . ' chapitres');

        // We take the manager of Chapters
        $manager = $this->managers->getManagerOf('Chapters');

        // Call the number of chapters we want in the DB
        $listeChapters = $manager->getList(0, $nbChapters);

        foreach ($listeChapters as $chapter) { // show the 200 first letters of the chapter as a description
            if (strlen($chapter->content()) > $nbOfStrings) {
                $start = substr($chapter->contenu(), 0, $nbOfStrings);
                $start = substr($start, 0, strrpos($start, ' ')) . '...';

                $chapter->setContent($start);
            }
        }

        // We add the variable $listeChapter to the view (which will be read in a list (ArrayAccess))
        $this->page->addVar('listeChapters', $listeChapters);
    }
}
