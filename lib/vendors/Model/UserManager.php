<?php
namespace Model;

use \Entity\User;
use \MiniFram\Manager;

abstract class UserManager extends Manager
{
    /**
     * Add a user
     * @return void
     */
    /* abstract public function add(); */

    /**
     * Get the user
     * @param $postUser User who needs to be taken
     * @return void
     */
    abstract public function getUser($postUser);

}
