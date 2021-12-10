<?php

namespace App\Controller;

use App\Entity\PurchaseRequest;
use App\Form\PurchaseRequestType;
use App\Repository\PurchaseRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/purchase_request")
 */
class PurchaseRequestController extends AbstractController
{
    /**
     * @Route("/", name="purchase_request_index", methods={"GET"})
     */
    public function index(PurchaseRequestRepository $purchaseRequestRepository): Response
    {
        return $this->render('purchase_request/index.html.twig', [
            'purchase_requests' => $purchaseRequestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="purchase_request_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $purchaseRequest = new PurchaseRequest();
        $form = $this->createForm(PurchaseRequestType::class, $purchaseRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($purchaseRequest);
            $entityManager->flush();

            return $this->redirectToRoute('purchase_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('purchase_request/new.html.twig', [
            'purchase_request' => $purchaseRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="purchase_request_show", methods={"GET"})
     */
    public function show(PurchaseRequest $purchaseRequest): Response
    {
        return $this->render('purchase_request/show.html.twig', [
            'purchase_request' => $purchaseRequest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="purchase_request_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PurchaseRequest $purchaseRequest): Response
    {
        $form = $this->createForm(PurchaseRequestType::class, $purchaseRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('purchase_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('purchase_request/edit.html.twig', [
            'purchase_request' => $purchaseRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="purchase_request_delete", methods={"POST"})
     */
    public function delete(Request $request, PurchaseRequest $purchaseRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$purchaseRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($purchaseRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('purchase_request_index', [], Response::HTTP_SEE_OTHER);
    }
}
