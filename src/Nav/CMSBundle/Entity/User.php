<?php
// src/Nav/CMSBundle/Entity/User.php

namespace Nav\CMSBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}