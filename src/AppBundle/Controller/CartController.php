<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Controller;

use AppBundle\Builder\PurchaseBuilder;
use AppBundle\Entity\Product;
use AppBundle\Entity\Purchase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CartController
 *
 * @package AppBundle\Controller
 */
class CartController extends Controller
{
    /**
     * Cart index
     *
     * @return Response
     */
    public function indexAction()
    {
        $products = $this->get('app.product.repository')->findAll();

        return $this->render('@App/cart/index.html.twig', [
            'products' => $products,
            'deliveryTax' => Purchase::DELIVERY_TAX,
        ]);
    }

    /**
     * Add Purchase
     *
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $data = $request->request->all();
        $productsForm = $data['quantity'];

        $purchaseService = $this->get('app.purchase.service');

        /** @var Purchase $purchase */
        $purchase = $purchaseService->createPurchase($productsForm);

        return $this->redirectToRoute('cart_pay', ['id' => $purchase->getId()]);
    }

    /**
     * Pay purchase
     *
     * @param Request $request
     * @param Purchase $purchase
     */
    public function payAction(Request $request, Purchase $purchase)
    {
        dump($purchase);die;
    }
}
