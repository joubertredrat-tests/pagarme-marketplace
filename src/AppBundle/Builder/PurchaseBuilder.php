<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Builder;

use AppBundle\Entity\Purchase;

/**
 * Class PurchaseBuilder
 *
 * @package AppBundle\Builder
 */
class PurchaseBuilder
{
    /**
     * Purchase entity
     *
     * @var Purchase
     */
    private $purchase;

    /**
     * PurchaseBuilder constructor
     */
    public function __construct()
    {
        $this->purchase = new Purchase();
    }

    /**
     * Add amount
     *
     * @param float $amount
     * @return PurchaseBuilder
     */
    public function addAmount(float $amount): PurchaseBuilder
    {
        $this->purchase->setAmount($amount);
        return $this;
    }

    /**
     * Add delivery tax
     *
     * @param float $deliveryTax
     * @return PurchaseBuilder
     */
    public function addDeliveryTax(float $deliveryTax): PurchaseBuilder
    {
        $this->purchase->setDeliveryTax($deliveryTax);
        return $this;
    }

    /**
     * Add status
     *
     * @param string $status
     * @return PurchaseBuilder
     */
    public function addStatus(string $status): PurchaseBuilder
    {
        if (in_array($status, Purchase::getAvailableStatus())) {
            $this->purchase->setStatus($status);
        }

        return $this;
    }

    /**
     * Add product
     *
     * @param Product $product
     * @return PurchaseBuilder
     */
    public function addProduct(Product $product): PurchaseBuilder
    {
        $this->purchase->addProduct($product);

        return $this;
    }

    /**
     * Get Purchase entity
     *
     * @return Purchase
     */
    public function get()
    {
        return $this->purchase;
    }
}
