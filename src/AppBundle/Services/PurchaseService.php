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
use AppBundle\Entity\Manufacturer;
use AppBundle\Entity\Product;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseProduct;
use AppBundle\Repository\ProductRepository;
use AppBundle\Repository\PurchaseProductRepository;
use AppBundle\Repository\PurchaseRepository;
use PagarMe\Sdk\PagarMe;

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
     * @var PagarMe
     */
    private $pagarMe;

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
     * Set PagarMe data
     *
     * @param string $apiKey
     */
    public function setPagarmeApiKey(string $apiKey)
    {
        $this->pagarMe = new PagarMe($apiKey);
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

    /**
     * Process transactions on Pagar.me
     *
     * @param Purchase $purchase
     * @param string $transactionToken
     * @return bool
     */
    public function transactionPagarme(Purchase $purchase, string $transactionToken): bool
    {
        $transaction = $this
            ->pagarMe
            ->transaction()
            ->get($transactionToken)
        ;

        $this
            ->pagarMe
            ->transaction()
            ->capture(
                $transaction,
                str_replace('.', '', $purchase->getAmount())
        );

        $purchase->setStatus(Purchase::STATUS_PAID);
        $this->purchaseRepository->update($purchase);

        return true;
    }

    /**
     * Create array data for report on view
     *
     * @param Purchase $purchase
     * @return array
     */
    public function getProductDataView(Purchase $purchase): array
    {
        $array = [];

        /** @var PurchaseProduct $purchaseProduct */
        foreach ($purchase->getProducts() as $purchaseProduct) {

            $row = [];
            $row['name'] = $purchaseProduct->getProduct()->getName();
            $row['price'] = $purchaseProduct->getPrice();
            $row['quantity'] = $purchaseProduct->getQuantity();

            if ($purchaseProduct->getProduct()->getManufacturer() instanceof Manufacturer) {
                $row['manufacturer'] = $purchaseProduct->getProduct()->getManufacturer()->getName();

                $total = $purchaseProduct->getPrice() * $purchaseProduct->getQuantity();
                $paymentOwner = $total * Purchase::OWNER_TAX;
                $paymentManufacturer = $total - $paymentOwner;

                $row['paymentOwner'] = $paymentOwner;
                $row['paymentManufacturer'] = $paymentManufacturer;
            } else {
                $row['manufacturer'] = '';
                $row['paymentOwner'] = $purchaseProduct->getPrice() * $purchaseProduct->getQuantity();
                $row['paymentManufacturer'] = '';
            }

            $array[] = $row;
        }

        return $array;
    }
}
