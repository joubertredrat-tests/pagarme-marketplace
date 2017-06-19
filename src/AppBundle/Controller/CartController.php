<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        ]);
    }
}