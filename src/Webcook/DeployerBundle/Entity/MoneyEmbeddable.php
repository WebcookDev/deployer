<?php

/**
 * This file is part of the Deploy module for webcook deployer.
 * Copyright (c) @see LICENSE
 */

namespace Webcook\DeployerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 * @author Tomas Voslar <tomas.voslar at webcook.cz>
 */
class MoneyEmbeddable extends \Money\Money
{
	/**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @var \Money\Currency 
	 *
	 * @ORM\Column(type="string")
     */
    private $currency;
}