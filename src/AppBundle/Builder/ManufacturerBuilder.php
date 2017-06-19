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

/**
 * Class ManufacturerBuilder
 *
 * @package AppBundle\Builder
 */
class ManufacturerBuilder
{
    /**
     * Manufacturer entity
     *
     * @var Manufacturer
     */
    private $manufacturer;

    /**
     * ManufacturerBuilder constructor
     */
    public function __construct()
    {
        $this->manufacturer = new Manufacturer();
    }

    /**
     * Add name
     *
     * @param $name
     * @return ManufacturerBuilder
     */
    public function addName(string $name): ManufacturerBuilder
    {
        $this->manufacturer->setName($name);
        return $this;
    }

    /**
     * Get manufacturer entity
     *
     * @return Manufacturer
     */
    public function get(): Manufacturer
    {
        return $this->manufacturer;
    }
}
