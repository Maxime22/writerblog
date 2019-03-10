<?php
namespace App\Frontend\Modules\About;

use \MiniFram\BackController;

class AboutController extends BackController
{
    public function executeIndex()
    {
        $this->page->addVar('title', "L'auteur");
    }

}
