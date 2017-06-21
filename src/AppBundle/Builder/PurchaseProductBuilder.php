<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Builder;

use AppBundle\Entity\Product;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseProduct;

/**
 * Class PurchaseProductBuilder
 *
 * @package AppBundle\Builder
 */
class PurchaseProductBuilder
{
    /**
     * @var PurchaseProduct
     */
    private $purchaseBuilder;

    /**
     * PurchaseProductBuilder constructor
     */
    public function __construct()
    {
        $this->purchaseBuilder = new PurchaseProduct();
    }

    /**
     * Add price
     *
     * @param float $price
     * @return PurchaseProductBuilder
     */
    public function addPrice(float $price): PurchaseProductBuilder
    {
        $this->purchaseBuilder->setPrice($price);
        return $this;
    }

    /**
     * Add uantity
     *
     * @param int $quantity
     * @return PurchaseProductBuilder
     */
    public function addQuantity(int $quantity): PurchaseProductBuilder
    {
        $this->purchaseBuilder->setQuantity($quantity);
        return $this;
    }

    /**
     * Add product
     *
     * @param Product $product
     * @return PurchaseProductBuilder
     */
    public function addProduct(Product $product): PurchaseProductBuilder
    {
        $this->purchaseBuilder->setProduct($product);
        return $this;
    }

    /**
     * Add purchase
     *
     * @param Purchase $purchase
     * @return PurchaseProductBuilder
     */
    public function addPurchase(Purchase $purchase): PurchaseProductBuilder
    {
        $this->purchaseBuilder->setPurchase($purchase);
        return $this;
    }

    /**
     * Get PurchaseProduct entity
     *
     * @return PurchaseProduct
     */
    public function get(): PurchaseProduct
    {
        return $this->purchaseBuilder;
    }
}
