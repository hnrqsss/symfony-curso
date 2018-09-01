<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 09:13
 */

namespace App\Controller;

use App\Response\ApiResponse;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;


class UserRestController extends FOSRestController
{
    private $users = [
        [
            'id' => 1,
            'nome' => 'Henrique',
            'email' => 'hnrq.assuncao@gmail.com'
        ],
        [
            'id' => 2,
            'nome' => 'Eduardo',
            'email' => 'eduardoroseo@gmail.com'
        ]
    ];

    /**
     * @param string $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function get(string $id)
    {

        return $this->users !== null ? ApiResponse::success('Usuário encontrado', $this->users[$id-1])
            : ApiResponse::error('Usuários não encontrados', ['error ao encontrar usuário']) ;

    }

    /**
     * @param string|null $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getAction(string $id = null) {

      if($id) {

          return $this->get((int) $id);
      }

      return $this->users !== null ? ApiResponse::success('Usuários encontrados', $this->users)
        : ApiResponse::error('Usuários não encontrados', ['error ao encontrar usuários']) ;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function postAction(Request $request) {

        $request = json_decode($request->getContent());

        return ApiResponse::success('usuário cadastrado', $request);
    }
}