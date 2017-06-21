<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Services;

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
}
