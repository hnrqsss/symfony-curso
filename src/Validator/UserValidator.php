<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 17:25
 */

namespace App\Validator;


use App\Document\User;

class UserValidator
{
    public function validateUser($request) {
        if(!isset($request->name) || strlen($request->name) < 3 )  {
            throw new \Exception('Nome inválido');
        }

        $this->emailIsValid($request->email);

        $this->passwordIsValid($request->password);

        return true;
    }

    private function passwordIsValid(string $password) {
        if(!isset($password) || strlen($password) < 3) {
            throw new \Exception('Senha inválida');
        }
    }

    private function emailIsValid($email)
    {
        if(!isset($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email inválido');
        }
    }

}