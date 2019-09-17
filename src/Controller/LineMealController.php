<?php

namespace App\Controller;

use App\Entity\LineMeal;
use App\Form\LineMealType;
use App\Repository\LineMealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/line/meal")
 */
class LineMealController extends AbstractController
{
    /**
     * @Route("/", name="line_meal_index", methods={"GET"})
     */
    public function index(LineMealRepository $lineMealRepository): Response
    {
        return $this->render('line_meal/index.html.twig', [
            'line_meals' => $lineMealRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="line_meal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lineMeal = new LineMeal();
        $form = $this->createForm(LineMealType::class, $lineMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lineMeal);
            $entityManager->flush();

            return $this->redirectToRoute('line_meal_index');
        }

        return $this->render('line_meal/new.html.twig', [
            'line_meal' => $lineMeal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="line_meal_show", methods={"GET"})
     */
    public function show(LineMeal $lineMeal): Response
    {
        return $this->render('line_meal/show.html.twig', [
            'line_meal' => $lineMeal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="line_meal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LineMeal $lineMeal): Response
    {
        $form = $this->createForm(LineMealType::class, $lineMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('line_meal_index');
        }

        return $this->render('line_meal/edit.html.twig', [
            'line_meal' => $lineMeal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="line_meal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LineMeal $lineMeal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lineMeal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lineMeal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('line_meal_index');
    }
}
