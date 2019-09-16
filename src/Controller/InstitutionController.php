<?php
namespace App\Controller;

use App\Entity\Institution;
use App\Form\InstitutionType;
use App\Repository\InstitutionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/institution")
 */


class InstitutionController extends AbstractController
{
    /**
     * @Route("/", name="institution_index", methods={"GET"})
     */
    public function index(InstitutionRepository $institutionRepository): Response
    {
        return $this->render('institution/index.html.twig', [
            'institutions' => $institutionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="institution_new",methods={"GET","POST"})
     */

    public function new(Request $request)
    {
        $institution = new Institution();
        $form = $this->createForm(InstitutionType::class, $institution);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($institution);
            $entityManager->flush();
            return $this->redirectToRoute('institution_index');
        }
        return $this->render('institution/new.html.twig', [
            'institution' => $institution,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="institution_show", methods={"GET"})
     */
    public function show(Institution $institution): Response
    {
        return $this->render('institution/show.html.twig', [
            'institution' => $institution,
        ]);
    }

    /**
     * @Route("/{id}", name="institution_edit", methods={"Get","POST"})
     */

    public function edit(Request $request, Institution $institution): Response
    {
        $form = $this->createForm(InstitutionType::class, $institution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('institution_index');
        }
        return $this->render('institution/edit.html.twig', [
            'institution' => $institution,
            'form' => $form->createVieww(),
        ]);
    }

    /**
     * @Route("/{id}", name="institution_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Institution $institution): Response
    {
        if ($this->isCsrfTokenValid('delete' . $institution->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($institution);
            $entityManager->flush();
        }
        return $this->redirectToRoute('institution_index');
    }
}