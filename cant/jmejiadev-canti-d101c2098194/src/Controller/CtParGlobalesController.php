<?php

namespace App\Controller;

use App\Entity\CtParGlobales;
use App\Form\CtParGlobalesType;
use App\Repository\CtParGlobalesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/par/globales")
 */
class CtParGlobalesController extends AbstractController
{
    /**
     * @Route("/", name="ct_par_globales_index", methods={"GET"})
     */
    public function index(CtParGlobalesRepository $ctParGlobalesRepository): Response
    {
        return $this->render('ct_par_globales/index.html.twig', [
            'ct_par_globales' => $ctParGlobalesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ct_par_globales_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctParGlobale = new CtParGlobales();
        $form = $this->createForm(CtParGlobalesType::class, $ctParGlobale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctParGlobale);
            $entityManager->flush();

            return $this->redirectToRoute('ct_par_globales_index');
        }

        return $this->render('ct_par_globales/new.html.twig', [
            'ct_par_globale' => $ctParGlobale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_par_globales_show", methods={"GET"})
     */
    public function show(CtParGlobales $ctParGlobale): Response
    {
        return $this->render('ct_par_globales/show.html.twig', [
            'ct_par_globale' => $ctParGlobale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_par_globales_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtParGlobales $ctParGlobale): Response
    {
        $form = $this->createForm(CtParGlobalesType::class, $ctParGlobale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_par_globales_index', [
                'id' => $ctParGlobale->getId(),
            ]);
        }

        return $this->render('ct_par_globales/edit.html.twig', [
            'ct_par_globale' => $ctParGlobale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_par_globales_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtParGlobales $ctParGlobale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctParGlobale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctParGlobale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_par_globales_index');
    }
}
