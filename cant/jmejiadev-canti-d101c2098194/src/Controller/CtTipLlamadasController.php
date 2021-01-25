<?php

namespace App\Controller;

use App\Entity\CtTipLlamadas;
use App\Form\CtTipLlamadasType;
use App\Repository\CtTipLlamadasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/tip/llamadas")
 */
class CtTipLlamadasController extends AbstractController
{
    /**
     * @Route("/", name="ct_tip_llamadas_index", methods={"GET"})
     */
    public function index(CtTipLlamadasRepository $ctTipLlamadasRepository): Response
    {
        return $this->render('ct_tip_llamadas/index.html.twig', [
            'ct_tip_llamadas' => $ctTipLlamadasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ct_tip_llamadas_new", methods={"GET","POST"})
     */
    public function new(Request $request, CtTipLlamadasRepository $ctTipLlamadasRepository): Response
    {
        $ctTipLlamada = new CtTipLlamadas();
        $form = $this->createForm(CtTipLlamadasType::class, $ctTipLlamada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctTipLlamada);
            $entityManager->flush();

            return $this->redirectToRoute('ct_tip_llamadas_index');
        }

        return $this->render('ct_tip_llamadas/new.html.twig', [
            'ct_tip_llamada' => $ctTipLlamada,
            'ct_tip_llamadas' => $ctTipLlamadasRepository->getAllTipLlamadas(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_tip_llamadas_show", methods={"GET"})
     */
    public function show(CtTipLlamadas $ctTipLlamada): Response
    {
        return $this->render('ct_tip_llamadas/show.html.twig', [
            'ct_tip_llamada' => $ctTipLlamada,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_tip_llamadas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtTipLlamadas $ctTipLlamada, CtTipLlamadasRepository $ctTipLlamadasRepository): Response
    {
        $form = $this->createForm(CtTipLlamadasType::class, $ctTipLlamada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_tip_llamadas_index', [
                'id' => $ctTipLlamada->getId(),
            ]);
        }

        return $this->render('ct_tip_llamadas/edit.html.twig', [
            'ct_tip_llamada' => $ctTipLlamada,
            'ct_tip_llamadas' => $ctTipLlamadasRepository->getEditTipLlamadas($ctTipLlamada->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_tip_llamadas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtTipLlamadas $ctTipLlamada): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTipLlamada->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctTipLlamada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_tip_llamadas_index');
    }
}
