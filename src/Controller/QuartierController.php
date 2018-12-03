<?php

namespace App\Controller;

use App\Entity\Quartier;
use App\Form\QuartierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quartier")
 */
class QuartierController extends AbstractController
{
    /**
     * @Route("/", name="quartier_index", methods="GET")
     */
    public function index(): Response
    {
        $quartiers = $this->getDoctrine()
            ->getRepository(Quartier::class)
            ->findAll();

        return $this->render('quartier/index.html.twig', ['quartiers' => $quartiers]);
    }

    /**
     * @Route("/new", name="quartier_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $quartier = new Quartier();
        $form = $this->createForm(QuartierType::class, $quartier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quartier);
            $em->flush();

            return $this->redirectToRoute('quartier_index');
        }

        return $this->render('quartier/new.html.twig', [
            'quartier' => $quartier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quartier_show", methods="GET")
     */
    public function show(Quartier $quartier): Response
    {
        return $this->render('quartier/show.html.twig', ['quartier' => $quartier]);
    }

    /**
     * @Route("/{id}/edit", name="quartier_edit", methods="GET|POST")
     */
    public function edit(Request $request, Quartier $quartier): Response
    {
        $form = $this->createForm(QuartierType::class, $quartier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quartier_index', ['id' => $quartier->getId()]);
        }

        return $this->render('quartier/edit.html.twig', [
            'quartier' => $quartier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quartier_delete", methods="DELETE")
     */
    public function delete(Request $request, Quartier $quartier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quartier->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($quartier);
            $em->flush();
        }

        return $this->redirectToRoute('quartier_index');
    }
}
