<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Form\AnnouncementForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AnnouncementController extends Controller
{
    /**
     * @Route("/announcement/create", name="announcement-create")
     * @Route("/announcement/edit/{id}", name="announcement-edit")
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
                $this->addFlash('success', $id ? 'Объявление изменено' : 'Объявление добавлено');

                return $this->redirectToRoute('announcement-list',
                    [
                        'city' => $form['city']->getData()->getId(),
                        'category' => $form['category']->getData()->getId()
                    ]);
            }
        }

        return $this->render('announcement/form.html.twig', [
            'id'   => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{city}/{category}/announcement", name="announcement-list")
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $category = $request->get('category');
        $city = $request->get('city');
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder('a')->select('a')
            ->from('App:Announcement', 'a')
            ->where('a.deleteTime IS NULL');
        $qb->andWhere('a.category = :category')
            ->setParameter(':category', $category)
            ->orderBy('a.id', 'DESC')
            ->andWhere('a.city = :city')
            ->setParameter(':city', $city)
        ;
        $announcements = $qb->getQuery()->getResult();

        return $this->render('announcement/list.html.twig', [
            'announcements' => $announcements,
            'city' => $city,
            'category' => $category
        ]);

    }

    /**
     * @Route("/{city}/{category}/announcement/view/{id}", name="announcement-view")
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        $announcement = $this->getDoctrine()->getRepository(Announcement::class)->find($id);

        return $this->render('announcement/view.html.twig', ['announcement' => $announcement]);

    }
}