<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 11:06
 */

namespace App\Controller;


use App\Response\ApiResponse;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class VehicleRestController extends FOSRestController
{
    private $vehicle = [
        [
            'id' => 1,
            'brand' => 'fiat',
            'model' => 'uno'
        ],
        [
            'id' => 2,
            'brand' => 'Renault',
            'model' => 'Logan'
        ]
    ];

    public function get(string $id) {
        return ApiResponse::success('Veículo encontrado', $this->vehicle[$id - 1]);
    }

    public function getAction(string $id = null) {

        if($id) {
            return $this->get((int) $id);
        }

        return ApiResponse::success('Veículos encontrados', $this->vehicle);

    }

    public function postAction(Request $request) {

        $request = json_decode($request->getContent());

        return ApiResponse::success('Veículo cadastrado',$request);
    }
}