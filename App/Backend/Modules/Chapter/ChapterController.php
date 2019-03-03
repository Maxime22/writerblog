<?php
namespace App\Backend\Modules\Chapter;

use \Entity\Chapter;
use \Entity\Comment;
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

    public function executeInsert(HTTPRequest $request)
    {
        if ($request->postExists('author')) {
            $this->processForm($request);
        }

        $this->page->addVar('title', 'Ajout d\'un chapitre');
    }

    public function executeUpdate(HTTPRequest $request)
    {
        if ($request->postExists('author')) {
            $this->processForm($request);
        } else {
            $this->page->addVar('chapter', $this->managers->getManagerOf('Chapter')->getUnique($request->getData('id')));
        }

        $this->page->addVar('title', 'Modification d\'un chapitre');
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
            $this->app->httpResponse()->redirect('/admin/'); // we redirect to the chapter page
        } else {
            $this->page->addVar('errors', $chapter->errors());
        }

        $this->page->addVar('chapter', $chapter);
    }

    public function executeDelete(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Chapter')->delete($request->getData('id'));

        $this->app->user()->setFlash('Le chapitre a bien été supprimé !');

        $this->app->httpResponse()->redirect('.');
    }

    public function executeUpdateComment(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'un commentaire');

        if ($request->postExists('author')) {
            $comment = new Comment([
                'id' => $request->getData('id'),
                'author' => $request->postData('author'),
                'content' => $request->postData('content'),
            ]);

            if ($comment->isValid()) {
                $this->managers->getManagerOf('Comments')->save($comment);

                $this->app->user()->setFlash('Le commentaire a bien été modifié !');

                $this->app->httpResponse()->redirect('/chapter-' . $request->postData('chapter'));
            } else {
                $this->page->addVar('errors', $comment->errors());
            }

            $this->page->addVar('comment', $comment);
        } else {
            $this->page->addVar('comment', $this->managers->getManagerOf('Comments')->get($request->getData('id')));
        }
    }

    public function executeDeleteComment(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comments')->delete($request->getData('id'));

        $this->app->user()->setFlash('Le commentaire a bien été supprimé !');

        $this->app->httpResponse()->redirect('.');
    }

}
