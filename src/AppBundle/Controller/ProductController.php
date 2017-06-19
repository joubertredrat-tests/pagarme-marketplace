<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Product controller
 *
 * @package AppBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * Lists all Product entities
     *
     * @return Response
     */
    public function indexAction()
    {
        $products = $this->get('app.product.repository')->findAll();

        return $this->render('@App/product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * Product new form
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(ProductType::class);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);
            $product = $form->getData();

            $this
                ->get('app.product.repository')
                ->add($product)
            ;

            $this->addFlash('positive', 'Product added');

            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('@App/product/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Product $product)
    {
        $form = $this->createForm('AppBundle\Form\ProductType', $product);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);
            $product = $form->getData();

            $this
                ->get('app.product.repository')
                ->update($product)
            ;

            $this->addFlash('positive', 'Product updated');

            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('@App/product/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes a Product entity
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function deleteAction(Product $product)
    {
        $this
            ->get('app.product.repository')
            ->delete($product)
        ;

        $this->addFlash('positive', 'Product removed');

        return $this->redirectToRoute('admin_product_index');
    }
}
