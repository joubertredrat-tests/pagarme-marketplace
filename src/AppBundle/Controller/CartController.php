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
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @param Purchase $purchase
     * @return Response
     */
    public function payAction(Purchase $purchase)
    {
        return $this->render('@App/cart/pay.html.twig', [
            'purchase' => $purchase,
            'deliveryTax' => Purchase::DELIVERY_TAX,
            'encryptionKey' => $this->getParameter('pagarme_encryption_key'),
            'statusPaid' => Purchase::STATUS_PAID
        ]);
    }

    /**
     * Process transaction from Pagar.me
     *
     * @param Request $request
     * @param Purchase $purchase
     * @return JsonResponse
     */
    public function transactionAction(Request $request, Purchase $purchase)
    {
        $transactionToken = $request->get('transactionToken');

        if (is_null($transactionToken)) {
            return new JsonResponse(
                ['message' => 'transactionToken is required'],
                Response::HTTP_BAD_REQUEST
            );
        }

        $purchaseService = $this->get('app.purchase.service');

        $purchaseService->transactionPagarme($purchase, $transactionToken);

        return new JsonResponse(['message' => 'Done']);
    }
}
