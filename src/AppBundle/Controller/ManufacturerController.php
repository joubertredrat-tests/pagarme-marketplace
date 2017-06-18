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
     * Lists all manufacturer entities.
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $manufacturers = $em->getRepository('AppBundle:Manufacturer')->findAll();

        return $this->render('manufacturer/index.html.twig', array(
            'manufacturers' => $manufacturers,
        ));
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

        return $this->render('manufacturer/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Manufacturer delete route
     *
     * @param Manufacturer $manufacturer
     * @return RedirectResponse
     */
    public function deleteAction(Manufacturer $manufacturer)
    {
        $this
            ->get('app.manufacturer.repository')
            ->delete($manufacturer)
        ;

        $this->addFlash('positive', 'Manufacturer removed');

        return $this->redirectToRoute('admin_manufacturer_index');
    }
}
