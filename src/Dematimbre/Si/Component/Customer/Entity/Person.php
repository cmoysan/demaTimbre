<?php

namespace Dematimbre\Si\Component\Customer\Entity;

use Gedmo\Timestampable\Traits\Timestampable;
use Majora\Framework\Model\CollectionableInterface;
use Majora\Framework\Model\CollectionableTrait;
use Majora\Framework\Serializer\Model\SerializableTrait;

/**
 * Person model class.
 */
class Person implements CollectionableInterface
{
    use CollectionableTrait, SerializableTrait, Timestampable;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $deviceToken;

    /**
     * return Person id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * define Person id.
     *
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * return Person firstname.
     *
     * @return int
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * define Person firstname.
     *
     * @param int $firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * return Person lastname.
     *
     * @return int
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * define Person lastname.
     *
     * @param int $lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * return Person email.
     *
     * @return int
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * define Person email.
     *
     * @param int $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * return Person deviceToken.
     *
     * @return int
     */
    public function getDeviceToken()
    {
        return $this->deviceToken;
    }

    /**
     * define Person deviceToken.
     *
     * @param int $deviceToken
     *
     * @return self
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;

        return $this;
    }

    /**
     * @see ScopableInterface::getScopes()
     */
    public static function getScopes()
    {
        return array(
            'default' => array('id', 'lastname', 'firstname', 'email', 'device_token'),
            'id' => 'id',
        );
    }
}
