<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 09:51
 */

namespace App\Response;


use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    /**
     * @param string $message
     * @param $data
     * @return JsonResponse
     */
    public static function success(string $message, $data) {
        return new JsonResponse(
            [
                'status'  => true,
                'message' => $message,
                'data'    => $data,
                'erros'   => null
            ]
        );
    }

    /**
     * @param string $message
     * @param array $errors
     * @return JsonResponse
     */
    public static function error(string $message, array $errors) {
        return new JsonResponse(
            [
                'status'  => true,
                'message' => $message,
                'data'    => null,
                'erros'   => $errors
            ]
        );
    }
}