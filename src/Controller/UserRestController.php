<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 09:13
 */

namespace App\Controller;

use App\Document\User;
use App\Repository\UserRepository;
use App\Response\ApiResponse;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;


class UserRestController extends FOSRestController
{

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function get(string $id)
    {
        try{
            $response = $this->repository->findOneBy(['id' => $id]);
        }catch (\Exception $exception) {
            ApiResponse::error('Usuários não encontrados', [$exception->getMessage()]) ;
        }

        if(!$response) {
            return ApiResponse::error('Usuário não encontrados', ['Id inválido']) ;
        }

        return ApiResponse::success('Usuário encontrado', $response->extract());
    }

    /**
     * @param string|null $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getAction(string $id = null) {

      if($id) {
          return $this->get($id);
      }

      try {

          $response = $this->repository->findAll();

          $response = array_map(function (User $user){
              return $user->extract();
          }, $response);

      } catch (\Exception $exception) {
          ApiResponse::error('Usuários não encontrados', [$exception->getMessage()]);
      }

      return ApiResponse::success('Usuários encontrados', $response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function postAction(Request $request) {

        $request = json_decode($request->getContent());

        $user = new User();
        $user->setName($request->name);
        $user->setEmail($request->email);
        $user->setPassword($request->password);
        $user->setRegistered(new \DateTime());
        $user->setUpdated(new \DateTime());


        try {
            $response = $this->repository->insert($user);
        } catch (\Exception $exception) {
            return ApiResponse::error('Error ao cadastrar o usuário',[$exception->getMessage()]);
        }

        return ApiResponse::success('usuário cadastrado', $response->extract());
    }
}