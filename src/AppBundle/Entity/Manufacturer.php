<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Product;
use AppBundle\Entity\Traits\DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Manufacturer Entity
 *
 * @package AppBundle\Entity
 */
class Manufacturer
{
    use DateTime;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ArrayCollection
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Manufacturer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get Products
     *
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products->getValues();
    }

    /**
     * Count products from this manufacturer
     *
     * @return int
     */
    public function countProducts(): int
    {
        return count($this->getProducts());
    }
}
