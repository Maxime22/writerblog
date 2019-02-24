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

    public function processForm(HTTPRequest $request)
    {
        $chapter = new Chapter([
            'author' => $request->postData('author'),
            'title' => $request->postData('title'),
            'content' => $request->postData('content'),
        ]);

        // The id of the chapter is sent if we want to modify it
        if ($request->postExists('id')) {
            $chapter->setId($request->postData('id'));
        }

        if ($chapter->isValid()) {
            $this->managers->getManagerOf('Chapter')->save($chapter);

            $this->app->user()->setFlash($chapter->isNew() ? 'Le chapitre a bien été ajouté!' : 'Le chapitre a bien été modifié !');
        } else {
            $this->page->addVar('erreurs', $chapter->errors());
        }

        $this->page->addVar('news', $chapter);
    }
}
