<?php

namespace App\Controller;

use App\Entity\Term;
use App\Form\TermType;
use App\Repository\TermRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/term")
 */
class TermController extends AbstractController
{
    /**
     * @Route("/", name="term_index", methods={"GET"})
     */
    public function index(TermRepository $termRepository): Response
    {
        return $this->render('term/index.html.twig', [
            'terms' => $termRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="term_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $term = new Term();
        $form = $this->createForm(TermType::class, $term);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($term);
            $entityManager->flush();

            return $this->redirectToRoute('term_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('term/new.html.twig', [
            'term' => $term,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="term_show", methods={"GET"})
     */
    public function show(Term $term): Response
    {
        return $this->render('term/show.html.twig', [
            'term' => $term,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="term_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Term $term): Response
    {
        $form = $this->createForm(TermType::class, $term);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('term_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('term/edit.html.twig', [
            'term' => $term,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="term_delete", methods={"POST"})
     */
    public function delete(Request $request, Term $term): Response
    {
        if ($this->isCsrfTokenValid('delete'.$term->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($term);
            $entityManager->flush();
        }

        return $this->redirectToRoute('term_index', [], Response::HTTP_SEE_OTHER);
    }
}
