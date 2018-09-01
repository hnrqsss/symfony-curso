<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 14:37
 */

namespace App\Repository;


use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\UnitOfWork;

class UserRepository extends DocumentRepository
{

    public function __construct(DocumentManager $dm)
    {
        parent::__construct($dm,
                            $dm->getUnitOfWork(),
                            $dm->getClassMetadata(User::class));
    }

    public function insert(User $user): User {
        $this->getDocumentManager()->persist($user);
        $this->getDocumentManager()->flush();

        return $user;
    }

//    public function

}