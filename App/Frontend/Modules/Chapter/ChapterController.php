<?php
namespace App\Frontend\Modules\Chapter;

use \Entity\Comment;
use \MiniFram\BackController;
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

        $this->page->addVar('title', $chapter->title());
        $this->page->addVar('chapter', $chapter);
        $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($chapter->id()));
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

        if ($request->method() == 'POST' && $form->isValid()) {
            $this->managers->getManagerOf('Comments')->save($comment);
            $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
            $this->app->httpResponse()->redirect('chapter-' . $request->getData('chapter'));
        }

        $this->page->addVar('comment', $comment);
        $this->page->addVar('form', $form->createView()); // We send the form to the view
        $this->page->addVar('title', 'Ajout d\'un commentaire');
    }

}
