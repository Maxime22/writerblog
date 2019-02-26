<?php
namespace App\Frontend\Modules\LegalNotices;

use \MiniFram\BackController;

class LegalNoticesController extends BackController
{
    public function executeIndex()
    {
        $this->page->addVar('title', "Mentions Légales");
    }

}
