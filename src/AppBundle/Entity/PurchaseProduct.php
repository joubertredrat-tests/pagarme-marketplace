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

/**
 * PurchaseProduct Entity
 *
 * @package AppBundle\Entity
 */
class PurchaseProduct
{
    use DateTime;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $price;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var Purchase
     */
    private $purchase;

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
     * Set price
     *
     * @param string $price
     *
     * @return PurchaseProduct
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return PurchaseProduct
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set product
     *
     * @param Product $product
     * @return PurchaseProduct
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return Purchase
     */
    public function getPurchase(): Purchase
    {
        return $this->purchase;
    }

    /**
     * @param Purchase $purchase
     */
    public function setPurchase(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }
}
