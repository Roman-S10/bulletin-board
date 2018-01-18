<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Form\AnnouncementForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/announcement")
 */
class AnnouncementController extends Controller
{
    /**
     * @Route("/create", name="announcement-create")
     * @Route("/edit/{id}", name="announcement-edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $announcement = $id ? $em->find('App:Announcement', $id) : new Announcement();

        if (!$em) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(AnnouncementForm::class, $announcement);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($announcement);
                $em->flush();
                $this->addFlash('success', $id ? 'Данные изменены.' : 'Данные сохранены');

                return $this->redirectToRoute('announcement-list');
            }
        }

        return $this->render('announcement/form.html.twig', [
            'id'   => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="announcement-list")
     * @return Response
     */
    public function listAction()
    {
        $announcements = $this->getDoctrine()->getRepository(Announcement::class)->findAll();

        return $this->render('announcement/list.html.twig', ['announcements' => $announcements]);

    }
}