<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Entity\Article;

use App\Form\PurchaseType;
use App\Repository\PurchaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Route("/purchase")
 */
class PurchaseController extends AbstractController
{  /**
 * @Route("/", name="purchase_index", methods={"GET"})
 */
    public function index(PurchaseRepository $purchaseRepository): Response
    {
        return $this->render('purchase/index.html.twig', [
            'purchases' => $purchaseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajout/purchase", name="ajout-purchase")
     * @Route("/modifier/purchase/{id}", name="modifier-purchase")
     * @Route("/new", name="purchase_new")
     *
     */
    public function purchase($id = null, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if (is_null($id))
            $purchase = new Purchase();
        else
            $purchase = $em->find(Purchase::class, $id);

        $form = $this->createForm(PurchaseType::class, $purchase);

        $oldLinePurchase = new ArrayCollection();
        foreach ($purchase->getLinePurchase() as $linePurchase)
            $oldLinePurchase->add($linePurchase);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid() && $form->isSubmitted()) {

                foreach ($oldLinePurchase as $linePurchase)
                    if (false === $purchase->getLinePurchase()->contains($linePurchase))
                        $em->remove($linePurchase);

                foreach ($purchase->getLinePurchase() as $linePurchase)
                    $linePurchase->setPurchase($purchase);

                $em->persist($purchase);
                $em->flush();
                $this->addFlash('success', "تمت العملية بنجاح");
                return $this->redirectToRoute("purchase_index");
            }
        }

        $purchases = $em->getRepository(Purchase::class)->findAll();
        $articles = $em->getRepository(Article::class)->findAll();


        return $this->render('purchase/purchase.html.twig', array(
            'form' => $form->createView(),
            'purchases' => $purchases,
            'articles' => $articles,
            'sousMenu' => array(['nom' => 'المشتريات', 'url' => 'ajout-purchase'])
        ));
    }



    /**
     * @Route("/delete/purchase/{id}", name="delete-purchase")
     *
     */
    public function delete(Purchase $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        return new Response(1);
    }
}

