<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/create", name="category-create")
     * @Route("/edit/{id}", name="category-edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $city = $id ? $em->find('App:Category', $id) : new Category();

        if (!$em) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(CategoryForm::class, $city);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($city);
                $em->flush();
                $this->addFlash('success', $id ? 'Данные изменены.' : 'Данные сохранены');

                return $this->redirectToRoute('category-list');
            }
        }

        return $this->render('category/form.html.twig', [
            'id'   => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="category-list")
     * @return Response
     */
    public function listAction()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('category/list.html.twig', ['categories' => $categories]);

    }
}