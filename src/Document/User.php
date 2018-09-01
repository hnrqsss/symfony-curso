<?php
/**
 * Created by PhpStorm.
 * User: HnrqSs
 * Date: 01/09/2018
 * Time: 14:14
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\HasLifecycleCallbacks;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PrePersist;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PreUpdate;
use Doctrine\ODM\MongoDB\Mapping\Annotations\UniqueIndex;

/**
 * Class User
 * @Document(collection="user")
 * @HasLifecycleCallbacks()
 */

class User
{
    /**
     * @var string $id
     * @Id()
     */
    private $id;

    /**
     * @var string $name
     * @Field(type="string")
     */
    private $name;

    /**
     * @var string $email
     * @Field(type="string") @UniqueIndex()
     */
    private $email;

    /**
     * @var string $password
     * @Field(type="string")
     */
    private $password;

    /**
     * @var \DateTime $registered
     * @Field(type="date")
     */
    private $registered;

    /**
     * @var \DateTime $updated
     * @Field(type="date")
     */
    private $updated;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return User
     */
    public function setId(string $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }


    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = password_hash($password, PASSWORD_ARGON2I);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRegistered(): \DateTime
    {
        return $this->registered;
    }

    /**
     * @param \DateTime $registered
     * @return User
     */
    public function setRegistered(\DateTime $registered): User
    {
        $this->registered = $registered;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return User
     */
    public function setUpdated(\DateTime $updated): User
    {
        $this->updated = $updated;
        return $this;
    }

    public function extract()
    {
        unset($this->password);
        return get_object_vars($this);
    }

    /**
     * @PrePersist()
     */
    public function prePersist() {
        $this->registered = new \DateTime();
        $this->updated = new \DateTime();
    }

    /**
     * @PreUpdate()
     */
    public function preUpdate() {
        $this->updated = new \DateTime();
    }

}