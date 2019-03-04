<?php
namespace App\Backend\Modules\Connexion;

use \MiniFram\BackController;
use \MiniFram\HTTPRequest;

class ConnexionController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Connexion');

        /* $this->managers->getManagerOf('User')->add(); */ // if we want to add another user

        if ($request->postExists('login')) {

            $manager = $this->managers->getManagerOf('User');
            $result = $manager->getUser($request->postData('login'));

            if (!$result) {
                $this->app->user()->setFlash('Mauvais login ou password !');
            } else {
                $isPasswordCorrect = password_verify($request->postData('password'), $result['password']);

                if ($isPasswordCorrect) {

                    $this->app->user()->setAuthenticated(true);
                    $this->app->user()->setAttribute('id', $result['id']); // registering the id and the login in session if we want to use it, we need to unset it at the deco
                    $this->app->user()->setAttribute('login', $result['login']);

                    $this->app->httpResponse()->redirect('.');

                } else {
                    $this->app->user()->setFlash('Mauvais login ou password !');
                }
            }
        }

    }

    public function executeDeconnexion(HTTPRequest $request)
    {

        $this->page->addVar('title', 'Deconnexion');

        if ($this->app->user()->isAuthenticated() != false) {
            $this->app->user()->setAuthenticated(false);
            $this->app->user()->setFlash('Vous avez été déconnecté de l\'espace utilisateur');
            unset($_SESSION['login']);
            unset($_SESSION['id']);
            $this->app->httpResponse()->redirect('/');
        }

    }
}
