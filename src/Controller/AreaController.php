<?php


namespace App\Controller;

use App\Entity\Area;
use App\Form\AreaForm;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/area")
 */
class AreaController extends Controller
{
    /**
     * @Route("/create", name="area-create")
     * @Route("/edit/{id}", name="area-edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $area = $id ? $em->find('App:Area', $id) : new Area();

        if (!$em) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(AreaForm::class, $area);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($area);
                $em->flush();
                $this->addFlash('success', $id ? 'Данные изменены.' : 'Область добавлена');

                return $this->redirectToRoute('admin');
            }
        }

        return $this->render('area/form.html.twig', [
            'id'   => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="area-list")
     * @return Response
     */
    public function listAction()
    {
        $areas = $this->getDoctrine()->getRepository(Area::class)->findAll();

        return $this->render('area/list.html.twig', ['areas' => $areas]);
    }
}