<?php
namespace App\Frontend\Modules\Chapter;

use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \MiniFram\BackController;
use \MiniFram\FormHandler;
use \MiniFram\HTTPRequest;

class ChapterController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Chapitres');

        $manager = $this->managers->getManagerOf('Chapter');

        $this->page->addVar('listChapters', $manager->getList());
    }

    public function executeShow(HTTPRequest $request)
    {
        $chapter = $this->managers->getManagerOf('Chapter')->getUnique($request->getData('id'));
        
        if (empty($chapter)) {
            $this->app->httpResponse()->redirect404();
        }

        $comments = $this->managers->getManagerOf('Comments')->getListOf($chapter->id());

        $this->page->addVar('title', $chapter->title());
        $this->page->addVar('chapter', $chapter);
        $this->page->addVar('comments', $comments);
        
    }

    public function executeInsertComment(HTTPRequest $request)
    {
        // If the form has been sent we fill it with the variables sent
        if ($request->method() == 'POST') {
            $comment = new Comment([
                'chapter' => $request->getData('chapter'),
                'author' => $request->postData('author'),
                'content' => $request->postData('content'),
            ]);
        } else {
            $comment = new Comment;
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

        if ($formHandler->process()) // check POST, isValid and save() the entity
        {
            $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
            $this->app->httpResponse()->redirect('chapter-' . $request->getData('chapter'));
        }

        $this->page->addVar('comment', $comment);
        $this->page->addVar('form', $form->createView()); // We send the form to the view
        $this->page->addVar('title', 'Ajout d\'un commentaire');
    }

    public function executeReportComment(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comments')->report($request->getData('id'));

        $this->app->user()->setFlash('Le commentaire a bien été signalé !');
        
        $_SERVER['HTTP_REFERER'] !== null ? $this->app->httpResponse()->redirect($_SERVER['HTTP_REFERER']) : $this->app->httpResponse()->redirect('.');
    }

}
