<?php
namespace Entity;

use \MiniFram\Entity;

class User extends Entity
{
    protected $login;
    protected $password;

    public function isValid()
    {
        return !(empty($this->login) || empty($this->password));
    }

    // SETTERS

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // GETTERS

    public function login()
    {
        return $this->login;
    }

    public function password(){
        return $this->password;
    }

}
