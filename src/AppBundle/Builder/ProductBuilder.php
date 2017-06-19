<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Builder;

use AppBundle\Entity\Manufacturer;
use AppBundle\Entity\Product;

/**
 * Class ProductBuilder
 *
 * @package AppBundle\Builder
 */
class ProductBuilder
{
    private $product;

    /**
     * ProductBuilder constructor
     */
    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * Add name
     *
     * @param $name
     * @return ProductBuilder
     */
    public function addName(string $name): ProductBuilder
    {
        $this->product->setName($name);
        return $this;
    }

    /**
     * Add price
     *
     * @param float $price
     * @return ProductBuilder
     */
    public function addPrice(float $price): ProductBuilder
    {
        $this->product->setPrice($price);
        return $this;
    }

    /**
     * Add Manufacturer
     *
     * @param Manufacturer $manufacturer
     * @return ProductBuilder
     */
    public function addManufacturer(Manufacturer $manufacturer): ProductBuilder
    {
        $this->product->setManufacturer($manufacturer);
        return $this;
    }

    /**
     * Get manufacturer entity
     *
     * @return Product
     */
    public function get(): Product
    {
        return $this->product;
    }
}
