<?php
namespace App\Backend\Modules\Connexion;

use \MiniFram\BackController;
use \MiniFram\HTTPRequest;

class ConnexionController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Connexion');

        if ($request->postExists('login')) {
            $login = $request->postData('login');
            $password = $request->postData('password');

            if ($login == $this->app->config()->get('login') && $password == $this->app->config()->get('pass')) { // we check the login and the password with the config file
                $this->app->user()->setAuthenticated(true);
                $this->app->httpResponse()->redirect('.');
            } else {
                $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
            }
        }
    }

    public function executeDeconnexion(HTTPRequest $request){

        $this->page->addVar('title', 'Deconnexion');

        if ($this->app->user()->isAuthenticated() != false){
            $this->app->user()->setAuthenticated(false);
            $this->app->user()->setFlash('Vous avez été déconnecté de l\'espace utilisateur');
            //session_destroy();
            /* unset($_SESSION['name']);
            unset($_SESSION['id']); */
            $this->app->httpResponse()->redirect('/'); 
        }

    }
}
