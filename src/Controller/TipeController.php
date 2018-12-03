<?php

namespace App\Controller;

use App\Entity\Tipe;
use App\Form\TipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipe")
 */
class TipeController extends AbstractController
{
    /**
     * @Route("/", name="tipe_index", methods="GET")
     */
    public function index(): Response
    {
        $tipes = $this->getDoctrine()
            ->getRepository(Tipe::class)
            ->findAll();

        return $this->render('tipe/index.html.twig', ['tipes' => $tipes]);
    }

    /**
     * @Route("/new", name="tipe_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $tipe = new Tipe();
        $form = $this->createForm(TipeType::class, $tipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipe);
            $em->flush();

            return $this->redirectToRoute('tipe_index');
        }

        return $this->render('tipe/new.html.twig', [
            'tipe' => $tipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipe_show", methods="GET")
     */
    public function show(Tipe $tipe): Response
    {
        return $this->render('tipe/show.html.twig', ['tipe' => $tipe]);
    }

    /**
     * @Route("/{id}/edit", name="tipe_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tipe $tipe): Response
    {
        $form = $this->createForm(TipeType::class, $tipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipe_index', ['id' => $tipe->getId()]);
        }

        return $this->render('tipe/edit.html.twig', [
            'tipe' => $tipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipe_delete", methods="DELETE")
     */
    public function delete(Request $request, Tipe $tipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipe->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipe);
            $em->flush();
        }

        return $this->redirectToRoute('tipe_index');
    }
}
