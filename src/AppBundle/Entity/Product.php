<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Product Entity
 *
 * @package AppBundle\Entity
 */
class Product
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
     * @var string
     */
    private $price;

    /**
     * @var Manufacturer
     */
    private $manufacturer;

    /**
     * @var ArrayCollection
     */
    private $purchases;

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
     * @return Product
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
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get product Manufacturer
     *
     * @return Manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set product Manufacturer
     *
     * @param Manufacturer $manufacturer
     */
    public function setManufacturer(Manufacturer $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * Add purchase
     *
     * @param PurchaseProduct $purchase
     * @return Product
     */
    public function addPurchase(PurchaseProduct $purchase)
    {
        $this->purchases[] = $purchase;

        return $this;
    }

    /**
     * Remove purchase
     *
     * @param PurchaseProduct $purchase
     */
    public function removePurchase(PurchaseProduct $purchase)
    {
        $this->purchases->removeElement($purchase);
    }

    /**
     * Get purchases
     *
     * @return ArrayCollection
     */
    public function getPurchases()
    {
        return $this->purchases->getValues();
    }

    /**
     * Count purchases from this product
     *
     * @return int
     */
    public function countPurchases(): int
    {
        return count($this->getPurchases());
    }
}
