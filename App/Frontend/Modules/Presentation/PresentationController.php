<?php
namespace App\Frontend\Modules\Presentation;

use \MiniFram\BackController;

class PresentationController extends BackController
{
    public function executeIndex()
    {
        $this->page->addVar('title', "Billet simple pour l'Alaska");
    }

}
