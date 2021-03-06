<?php

/**
 * This file is part of the Deploy module for webcook deployer.
 * Copyright (c) @see LICENSE
 */

namespace Webcook\DeployerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Server holds information about production server.
 * 
 * From this entity information will be deployed application to the production server.
 * 
 * @ORM\Entity
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class Server
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    public $id;

    /**
     * Server's name.
     * 
     * @ORM\Column(unique=true)
     * @var string
     */
    private $name;

    /**
     * Server's ip address.
     * 
     * @ORM\Column()
     * @var string
     */
    private $ip;

    /**
     * Server's costs.
     * 
     * @ORM\Embedded(class="MoneyEmbeddable")
     * @var integer
     */
    private $costPrice;

    /**
     * Path to the production environment.
     * 
     * @ORM\Column()
     * @var string
     */
    private $path;

    /**
     * Applications associated with the production server.
     * 
     * @orm\ManyToMany(targetEntity="Application", mappedBy="servers")
     */
    private $applications;

    /**
     * Initialize applications array collection.
     */
    public function __construct()
    {
        $this->applications = new \Doctrine\Common\Collections\ArrayCollection;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add application instance into collection.
     * 
     * @param Application $application Application instance.
     */
    public function addApplication(Application $application)
    {
        $this->applications->add($application);
    }

    /**
     * Gets the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param string $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of ip.
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Sets the value of ip.
     *
     * @param string $ip the ip
     *
     * @return self
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Gets the value of path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets the value of path.
     *
     * @param string $path the path
     *
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Gets the value of applications.
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getApplications()
    {
        return $this->applications;
    }

    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;

        return $this;
    }

    public function getCostPrice()
    {
        return $this->costPrice;
    }
}
