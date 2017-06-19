<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Manufacturer;
use AppBundle\Form\ManufacturerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Manufacturer controller
 *
 * @package AppBundle\Controller
 */
class ManufacturerController extends Controller
{
    /**
     * Lists all Manufacturer entities
     *
     * @return Response
     */
    public function indexAction()
    {
        $manufacturers = $this->get('app.manufacturer.repository')->findAll();

        return $this->render('@App/manufacturer/index.html.twig', [
            'manufacturers' => $manufacturers,
        ]);
    }

    /**
     * Manufacturer new form
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(
            ManufacturerType::class
        );

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);
            $manufacturer = $form->getData();

            $this
                ->get('app.manufacturer.repository')
                ->add($manufacturer)
            ;

            $this->addFlash('positive', 'Manufacturer added');

            return $this->redirectToRoute('admin_manufacturer_index');
        }

        return $this->render('@App/manufacturer/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing manufacturer entity
     *
     * @param Request $request
     * @param Manufacturer $manufacturer
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Manufacturer $manufacturer)
    {
        $form = $this->createForm('AppBundle\Form\ManufacturerType', $manufacturer);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);
            $manufacturer = $form->getData();

            $this
                ->get('app.manufacturer.repository')
                ->update($manufacturer)
            ;

            $this->addFlash('positive', 'Manufacturer updated');

            return $this->redirectToRoute('admin_manufacturer_index');
        }

        return $this->render('@App/manufacturer/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes a Manufacturer entity
     *
     * @param Manufacturer $manufacturer
     * @return RedirectResponse
     */
    public function deleteAction(Manufacturer $manufacturer)
    {
        if ($manufacturer->getProducts()) {
            $this->addFlash('negative', 'You can not delete Manufacturer while have products');
        } else {
            $this
                ->get('app.manufacturer.repository')
                ->delete($manufacturer)
            ;

            $this->addFlash('positive', 'Manufacturer removed');
        }

        return $this->redirectToRoute('admin_manufacturer_index');
    }
}
