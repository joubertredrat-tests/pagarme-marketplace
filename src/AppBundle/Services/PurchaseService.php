<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Services;

use AppBundle\Builder\PurchaseBuilder;
use AppBundle\Builder\PurchaseProductBuilder;
use AppBundle\Entity\Product;
use AppBundle\Entity\Purchase;
use AppBundle\Repository\ProductRepository;
use AppBundle\Repository\PurchaseProductRepository;
use AppBundle\Repository\PurchaseRepository;

/**
 * Purchase Service
 *
 * @package AppBundle\Services
 */
class PurchaseService
{
    /**
     * @var PurchaseRepository
     */
    private $purchaseRepository;

    /**
     * @var PurchaseProductRepository
     */
    private $purchaseProductRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * PurchaseService constructor
     *
     * @param PurchaseRepository $purchaseRepository
     * @param PurchaseProductRepository $purchaseProductRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        PurchaseRepository $purchaseRepository,
        PurchaseProductRepository $purchaseProductRepository,
        ProductRepository $productRepository
    ) {
        $this->purchaseRepository = $purchaseRepository;
        $this->purchaseProductRepository = $purchaseProductRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Store new purchase on database
     *
     * @return Purchase
     */
    private function getNewPurchase()
    {
        $purchaseBuilder = new PurchaseBuilder();
        $purchase = $purchaseBuilder
            ->addDeliveryTax(Purchase::DELIVERY_TAX)
            ->addStatus(Purchase::STATUS_WAITING)
            ->get()
        ;

        $this->purchaseRepository->add($purchase);

        return $purchase;
    }

    /**
     * Create new purchase
     *
     * @param array $products
     * @return Purchase
     */
    public function createPurchase(array $products): Purchase
    {
        $purchase = $this->getNewPurchase();

        $amount = [];
        $amount[] = Purchase::DELIVERY_TAX;

        foreach ($products as $id => $quantity) {
            if ($quantity > 0) {
                /** @var Product $product */
                $product = $this->productRepository->find($id);

                $purchaseProductBuilder = new PurchaseProductBuilder();

                $purchaseProduct = $purchaseProductBuilder
                    ->addPrice($product->getPrice())
                    ->addQuantity($quantity)
                    ->addPurchase($purchase)
                    ->addProduct($product)
                    ->get()
                ;

                $this->purchaseProductRepository->add($purchaseProduct);

                $amount[] = $product->getPrice() * $quantity;
            }
        }

        $purchase->setAmount(array_sum($amount));
        $this->purchaseRepository->update($purchase);

        return $purchase;
    }
}
