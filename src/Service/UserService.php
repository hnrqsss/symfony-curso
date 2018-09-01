<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 15:36
 */

namespace App\Service;


use App\Repository\UserRepository;

class UserService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


}