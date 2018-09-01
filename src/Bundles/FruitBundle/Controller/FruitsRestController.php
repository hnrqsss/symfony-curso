<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 11:35
 */

namespace App\Bundles\FruitBundle\Controller;


class FruitsRestController
{
    private $fruits = [
        [
            "id" => 1,
            "name" => "apple"
        ],
        [
            "id" => 2,
            "name" => "banana"
        ]
    ];

    public function getAction(string $id = null) {

    }

    public function get(string $id) {

    }
}