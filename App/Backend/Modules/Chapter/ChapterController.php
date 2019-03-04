<?php
namespace App\Backend\Modules\Chapter;

use \Entity\Chapter;
use \Entity\Comment;
use \FormBuilder\ChapterFormBuilder;
use \FormBuilder\CommentFormBuilder;
use \MiniFram\BackController;
use \MiniFram\FormHandler;
use \MiniFram\HTTPRequest;

class ChapterController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Espace admin');

        $manager = $this->managers->getManagerOf('Chapter');
        $managerComment = $this->managers->getManagerOf('Comments');

        $this->page->addVar('listChapters', $manager->getList());
        $this->page->addVar('numberOfChapters', $manager->count());

        $this->page->addVar('listCommentsReported', $managerComment->getListOfReportedComments());
    }

    public function executeInsert(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Ajout d\'un chapitre');
    }

    public function executeUpdate(HTTPRequest $request)
    {
        $this->processForm($request);
        $this->page->addVar('title', 'Modification d\'un chapitre');
    }

    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $chapter = new Chapter([
                'author' => $request->postData('author'),
                'title' => $request->postData('title'),
                'content' => $request->postData('content'),
            ]);

            if ($request->getExists('id')) {
                $chapter->setId($request->getData('id'));
            }
        } else {
            // Id of the chapter is sent if we want to modify it
            if ($request->getExists('id')) {
                $chapter = $this->managers->getManagerOf('Chapter')->getUnique($request->getData('id'));
            } else // Otherwise we create a new chapter
            {
                $chapter = new Chapter;
            }
        }

        $formBuilder = new ChapterFormBuilder($chapter);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Chapter'), $request);

        if ($formHandler->process()) // check POST, isValid and save() the entity
        {
            $this->app->user()->setFlash($chapter->isNew() ? 'Le chapitre a bien été ajouté !' : 'Le chapitre a bien été modifié !');
            $this->app->httpResponse()->redirect('/admin/');
        }

        $this->page->addVar('form', $form->createView());
    }

    public function executeDelete(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Chapter')->delete($request->getData('id'));
        $this->managers->getManagerOf('Comments')->deleteFromChapter($request->getData('id'));

        $this->app->user()->setFlash('Le chapitre a bien été supprimé avec tous ses commentaires !');

        $this->app->httpResponse()->redirect('.');
    }

    public function executeUpdateComment(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'un commentaire');

        if ($request->method() == 'POST') {
            $comment = new Comment([
                'id' => $request->getData('id'),
                'author' => $request->postData('author'),
                'content' => $request->postData('content'),
                'chapter' => $request->getData('chapter'),
            ]);
        } else {
            $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

        if ($formHandler->process()) // check POST, isValid and save() the entity
        {
            $this->app->user()->setFlash('Le commentaire a bien été modifié');
            $this->app->httpResponse()->redirect('/admin/');
            
        }

        $this->page->addVar('form', $form->createView());
    }

    public function executeDeleteComment(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comments')->delete($request->getData('id'));

        $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
        
        $_SERVER['HTTP_REFERER'] !== null ? $this->app->httpResponse()->redirect($_SERVER['HTTP_REFERER']) : $this->app->httpResponse()->redirect('.');
    }

    public function executeReportComment(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comments')->report($request->getData('id'));

        $this->app->user()->setFlash('Le commentaire a bien été signalé !');
        
        $_SERVER['HTTP_REFERER'] !== null ? $this->app->httpResponse()->redirect($_SERVER['HTTP_REFERER']) : $this->app->httpResponse()->redirect('.');
    }

}
