<?php
namespace App\Auth;

use Cake\Auth\AbstractPasswordHasher;

class Md5PasswordHasher extends AbstractPasswordHasher
{

    public function hash($password) {
        return md5($password);
    }

    public function check($password, $hashedPassword) {
        return md5($password) === $hashedPassword;
    }
}