<?php

namespace App\Controller;

use App\Entity\Hiring;
use App\Form\HiringType;
use App\Repository\HiringRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hiring")
 */
class HiringController extends AbstractController
{
    /**
     * @Route("/", name="hiring_index", methods={"GET"})
     */
    public function index(HiringRepository $hiringRepository): Response
    {
        return $this->render('hiring/index.html.twig', [
            'hirings' => $hiringRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="hiring_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hiring = new Hiring();
        $form = $this->createForm(HiringType::class, $hiring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hiring);
            $entityManager->flush();

            return $this->redirectToRoute('hiring_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hiring/new.html.twig', [
            'hiring' => $hiring,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hiring_show", methods={"GET"})
     */
    public function show(Hiring $hiring): Response
    {
        return $this->render('hiring/show.html.twig', [
            'hiring' => $hiring,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hiring_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hiring $hiring): Response
    {
        $form = $this->createForm(HiringType::class, $hiring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hiring_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hiring/edit.html.twig', [
            'hiring' => $hiring,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hiring_delete", methods={"POST"})
     */
    public function delete(Request $request, Hiring $hiring): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hiring->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hiring);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hiring_index', [], Response::HTTP_SEE_OTHER);
    }
}
