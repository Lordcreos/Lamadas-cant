<?php

namespace App\Controller;

use App\Entity\CtCampanas;
use App\Form\CtCampanasType;
use App\Repository\CtCampanasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/campanas")
 */
class CtCampanasController extends AbstractController
{
    /**
     * @Route("/", name="ct_campanas_index", methods={"GET"})
     */
    public function index(CtCampanasRepository $ctCampanasRepository): Response
    {
        return $this->render('ct_campanas/index.html.twig', [
            'ct_campanas' => $ctCampanasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ct_campanas_new", methods={"GET","POST"})
     */
    public function new(Request $request, CtCampanasRepository $ctCampanasRepository): Response
    {
        $ctCampana = new CtCampanas();
        $form = $this->createForm(CtCampanasType::class, $ctCampana);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctCampana);
            $entityManager->flush();

            return $this->redirectToRoute('ct_campanas_index');
        }

        return $this->render('ct_campanas/new.html.twig', [
            'ct_campana' => $ctCampana,
            'ct_campanas' => $ctCampanasRepository->getAllCampanas(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_campanas_show", methods={"GET"})
     */
    public function show(CtCampanas $ctCampana): Response
    {
        return $this->render('ct_campanas/show.html.twig', [
            'ct_campana' => $ctCampana,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_campanas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtCampanas $ctCampana, CtCampanasRepository $ctCampanasRepository): Response
    {
        $form = $this->createForm(CtCampanasType::class, $ctCampana);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_campanas_index', [
                'id' => $ctCampana->getId(),
            ]);
        }

        return $this->render('ct_campanas/edit.html.twig', [
            'ct_campana' => $ctCampana,
            'ct_campanas' => $ctCampanasRepository->getEditCampanas($ctCampana->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_campanas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtCampanas $ctCampana): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctCampana->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctCampana);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_campanas_index');
    }
}
