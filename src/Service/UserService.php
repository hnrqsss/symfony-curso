<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 15:36
 */

namespace App\Service;


use App\Document\User;
use App\Repository\UserRepository;
use App\Validator\UserValidator;

class UserService
{
    private $repository;
    private $validador;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validador = $validator;
    }

    public function insert($request)
    {

        $this->validador->validateUser($request);

        if($this->repository->findBy(['email' => $request->email])) {
            throw new \Exception('Email já existe');
        }

        $user = new User();
        $user->setName($request->name)
              ->setEmail($request->email)
              ->setPassword($request->password);

        $user = $this->repository->insert($user);

        return $user->extract();

    }

    public function findAll()
    {
        $users = $this->repository->findAll();

        $users = array_map(function(User $user) {
            return $user->extract();
        }, $users);

        return $users;
    }

    public function updateById(string $id,  $request) {

        $userExists = $this->findOneById($id);

        $userExists
                ->setName($request->name ?? $userExists->getName())
                ->setEmail($request->email ?? $userExists->getEmail());

        if(isset($request->password)) {
            $userExists->setPassword($request->password);
        }

        $this->repository->updateById($id,$userExists);

        return $userExists;
    }

    public function findOneById(string $id) : User
    {
        $result = $this->repository->findOneBy(['id' => $id]);

        if(!$result) {
            throw new \Exception('Id não encontrado');
        }

        return $result;
    }

    public function deleteById(string $id) {

        $userExists = $this->findOneById($id);

        $this->repository->deleteOne($userExists);


    }

}