<?php 

require_once('core/BaseModel.php');

class UserModel extends BaseModel
{
    public function getUserByUsername($username)
    {
        return $this->query("SELECT * FROM users WHERE username = '$username'")[0];
    }
}