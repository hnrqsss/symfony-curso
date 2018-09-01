<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 14:14
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/**
 * Class User
 * @Document(collection="user")
 */

class User
{
    /**
     * @var string $id
     * @Id()
     */
    private $id;
}