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
use App\Service\UserService;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;


class UserRestController extends FOSRestController
{

    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function get(string $id)
    {
        try{

            $response = $this->service->findOneById($id);

        }catch (\Exception $exception) {
            ApiResponse::error('Usuários não encontrados', [$exception->getMessage()]) ;
        }

        return ApiResponse::success('Usuário encontrado', $response);
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
          $response = $this->service->findAll();
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

        try {
            $response = $this->service->insert($request);
        } catch (\Exception $exception) {
            return ApiResponse::error('Error ao cadastrar o usuário',[$exception->getMessage()]);
        }

        return ApiResponse::success('usuário cadastrado', $response);
    }

    public function putAction(string $id, Request $request) {

        $request = json_decode($request->getContent());

        try{
            $response = $this->service->updateById($id,$request);
        }catch (\Exception $exception ) {
            return ApiResponse::error('Erro ao atualizar registro', [$exception->getMessage()]);
        }

        return ApiResponse::success('Usuário atualizado com sucesso', $response->extract());
    }

    public function deleteAction(string $id) {

        try {
            $this->service->deleteById($id);

        }catch (\Exception $exception) {
            ApiResponse::error('Erro ao deletar o usuário', [$exception->getMessage()]);
        }

        return ApiResponse::success('Usuário deletado com sucesso',[]);
    }
}