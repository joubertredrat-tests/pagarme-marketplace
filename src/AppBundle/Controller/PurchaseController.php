<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Purchase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Purchase controller
 *
 * @package AppBundle\Controller
 */
class PurchaseController extends Controller
{
    /**
     * Lists all purchase entities
     *
     * @return Response
     */
    public function indexAction()
    {
        $purchases = $this->get('app.purchase.repository')->findAll();

        return $this->render('@App/purchase/index.html.twig', [
            'purchases' => $purchases,
        ]);


    }

    /**
     * Finds and displays a purchase entity
     *
     * @param Purchase $purchase
     * @return Response
     */
    public function showAction(Purchase $purchase)
    {
        $products = $this->get('app.purchase.service')->getProductDataView($purchase);

        return $this->render('@App/purchase/show.html.twig', [
            'purchase' => $purchase,
            'products' => $products,
            'deliveryTax' => Purchase::DELIVERY_TAX,
        ]);
    }
}
