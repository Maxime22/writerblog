<?php
namespace App\Frontend;

use \MiniFram\Application;

class FrontendApplication extends Application
{

    public function __construct()
    {
        var_dump("coucou");
        die;
        parent::__construct();
        $this->name = "Frontend";
    }

    public function run()
    {
        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }

}
