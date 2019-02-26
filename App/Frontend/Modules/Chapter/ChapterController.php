<?php
namespace App\Frontend\Modules\Chapter;

use \MiniFram\BackController;
use \MiniFram\HTTPRequest;
use \Entity\Comment;

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
        $this->page->addVar('title', 'Ajout d\'un commentaire');

        if ($request->postExists('author')) {
            $comment = new Comment([
                'chapter' => $request->getData('chapter'),
                'author' => $request->postData('author'),
                'content' => $request->postData('content'),
            ]);

            if ($comment->isValid()) {
                $this->managers->getManagerOf('Comments')->save($comment);

                $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');

                $this->app->httpResponse()->redirect('chapter-' . $request->getData('chapter')); // we redirect to the chapter page
            } else {
                $this->page->addVar('errors', $comment->errors());
            }

            $this->page->addVar('comment', $comment);
        }
    }

}
