<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/city")
 */
class CityController extends Controller
{
    /**
     * @Route("/create", name="city-create")
     * @Route("/edit/{id}", name="city-edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $city = $id ? $em->find('App:City', $id) : new City();

        if (!$em) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(CityForm::class, $city);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($city);
                $em->flush();
                $this->addFlash('success', $id ? 'Данные изменены.' : 'Данные сохранены');

                return $this->redirectToRoute('city-list');
            }
        }

        return $this->render('city/form.html.twig', [
            'id'   => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="city-list")
     * @return Response
     */
    public function listAction()
    {
        $cities = $this->getDoctrine()->getRepository(City::class)->findAll();

        return $this->render('city/list.html.twig', ['cities' => $cities]);

    }
}