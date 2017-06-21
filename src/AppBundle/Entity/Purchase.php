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
 * Purchase Entity
 *
 * @package AppBundle\Entity
 */
class Purchase
{
    use DateTime;

    /**
     * Purchase status
     */
    const STATUS_WAITING = 'waiting';
    const STATUS_PAID = 'paid';
    const STATUS_REFUSED = 'refused';

    /**
     * Delivery tax
     */
    const DELIVERY_TAX = 45.00;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $deliveryTax;

    /**
     * @var string
     */
    private $status;

    /**
     * @var ArrayCollection
     */
    private $products;

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
     * Set amount
     *
     * @param string $amount
     * @return Purchase
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set deliveryTax
     *
     * @param string $deliveryTax
     * @return Purchase
     */
    public function setDeliveryTax($deliveryTax)
    {
        $this->deliveryTax = $deliveryTax;

        return $this;
    }

    /**
     * Get deliveryTax
     *
     * @return string
     */
    public function getDeliveryTax()
    {
        return $this->deliveryTax;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * Add product
     *
     * @param PurchaseProduct $product
     * @return Purchase
     */
    public function addProduct(PurchaseProduct $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param PurchaseProduct $product
     */
    public function removeProduct(PurchaseProduct $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products->getValues();
    }

    /**
     * Count products from this purchase
     *
     * @return int
     */
    public function countPurchases(): int
    {
        return count($this->getProducts());
    }

    /**
     * Get available status
     *
     * @return array
     */
    public static function getAvailableStatus()
    {
        return [
            self::STATUS_PAID,
            self::STATUS_WAITING,
            self::STATUS_REFUSED,
        ];
    }
}
