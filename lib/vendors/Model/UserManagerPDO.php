<?php
namespace Model;

use \Entity\User;

class UserManagerPDO extends UserManager
{
    /* public function add()
    {
        $request = $this->dao->prepare('INSERT INTO users SET login = :login, password = :password');

        $request->bindValue(':login', '');
        $request->bindValue(':password', password_hash('', PASSWORD_DEFAULT));

        $request->execute();
    }
 */
    public function getUser($postUser)
    {
        $sql ='SELECT id, login, password FROM users WHERE login = :login';
        
        $request = $this->dao->prepare($sql);
        
        $request->execute(array('login' => $postUser));
        
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        
        $resultUser = $request->fetch();
        
        return $resultUser;
        
    }
}
