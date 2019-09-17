<?php

namespace App\Controller;

use App\Entity\Delivry;
use App\Form\DelivryType;
use App\Repository\DelivryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/delivry")
 */
class DelivryController extends AbstractController
{
    /**
     * @Route("/", name="delivry_index", methods={"GET"})
     */
    public function index(DelivryRepository $delivryRepository): Response
    {
        return $this->render('delivry/index.html.twig', [
            'delivries' => $delivryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="delivry_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $delivry = new Delivry();
        $form = $this->createForm(DelivryType::class, $delivry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($delivry);
            $entityManager->flush();

            return $this->redirectToRoute('delivry_index');
        }

        return $this->render('delivry/new.html.twig', [
            'delivry' => $delivry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delivry_show", methods={"GET"})
     */
    public function show(Delivry $delivry): Response
    {
        return $this->render('delivry/show.html.twig', [
            'delivry' => $delivry,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="delivry_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Delivry $delivry): Response
    {
        $form = $this->createForm(DelivryType::class, $delivry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('delivry_index');
        }

        return $this->render('delivry/edit.html.twig', [
            'delivry' => $delivry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delivry_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Delivry $delivry): Response
    {
        if ($this->isCsrfTokenValid('delete'.$delivry->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($delivry);
            $entityManager->flush();
        }

        return $this->redirectToRoute('delivry_index');
    }
}
