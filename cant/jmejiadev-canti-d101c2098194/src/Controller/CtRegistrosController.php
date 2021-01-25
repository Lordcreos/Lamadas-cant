<?php

namespace App\Controller;

use App\Entity\CtRegistros;
use App\Form\CtRegistrosType;
use App\Repository\CtRegistrosRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/registros")
 */
class CtRegistrosController extends AbstractController
{
    /**
     * @Route("/distribuir", name="ct_registros_distribuir", methods={"POST"})
     */
    public function distribuir(CtRegistrosRepository $ctRegistrosRepository, UserRepository $userRepository): Response
    {
        $registros = $_POST['registros'];
        $asesor = $_POST['asesor'];
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $mensaje = "Correcto";
        foreach ($registros as $registro){
            $reg = $ctRegistrosRepository->find($registro);
            $minVentas = $userRepository->getUserByCount($user->getCtcampanas()->getId());
            if($minVentas) {
                $reg->setUseraxis($userRepository->find($asesor));
                $reg->setRegEstado('ASIGNADO');
                $entityManager->persist($reg);
                $entityManager->flush();
            }else{
                $mensaje = "No existen vendedores asignados a la campaña: ". $user->getCtcampanas()->getCamNombre();
            }
        }
        return new Response($mensaje,200);
    }

    /**
     * @Route("/reporteria-agente", name="ct_registros_reporteria_agente", methods={"GET"})
     */
    public function reporteria_agente(CtRegistrosRepository $ctRegistrosRepository): Response
    {
        $user = $this->getUser();
        return $this->render('ct_registros/reporteria_agente.html.twig', [
            'ct_registros' => $ctRegistrosRepository->getRegistrosByAgente($user->getId()),
            //'ct_registros' => $ctRegistrosRepository->findBy(array('ctcampanas'=>$user->getCtcampanas()->getId(),'regEstado'=>'REGISTRADO')),
        ]);
    }

    /**
     * @Route("/reporteria-ventas-agente", name="ct_registros_reporteria_ventas_agente", methods={"GET"})
     */
    public function reporteria_ventas_agente(CtRegistrosRepository $ctRegistrosRepository): Response
    {
        $user = $this->getUser();
        return $this->render('ct_registros/reporteria_ventas.html.twig', [
            'ct_registros' => $ctRegistrosRepository->getRegistrosByUseraxis($user->getId(),'ATENDIDO'),
            //'ct_registros' => $ctRegistrosRepository->findBy(array('ctcampanas'=>$user->getCtcampanas()->getId(),'regEstado'=>'REGISTRADO')),
        ]);
    }
    /**
     * @Route("/reporteria-ventas", name="ct_registros_reporteria_ventas", methods={"GET"})
     */
    public function reporteria_ventas(CtRegistrosRepository $ctRegistrosRepository): Response
    {
        $user = $this->getUser();
        return $this->render('ct_registros/reporteria_ventas.html.twig', [
            'ct_registros' => $ctRegistrosRepository->getRegistrosByEstados(array('ATENDIDO')),
            //'ct_registros' => $ctRegistrosRepository->findBy(array('ctcampanas'=>$user->getCtcampanas()->getId(),'regEstado'=>'REGISTRADO')),
        ]);
    }
    /**
     * @Route("/reporteria-gestion", name="ct_registros_reporteria_gestion", methods={"GET"})
     */
    public function reporteria_gestion(CtRegistrosRepository $ctRegistrosRepository): Response
    {
        $user = $this->getUser();
        return $this->render('ct_registros/reporteria_gestion.html.twig', [
            'ct_registros' => $ctRegistrosRepository->getAllRegistros(),
            //'ct_registros' => $ctRegistrosRepository->findBy(array('ctcampanas'=>$user->getCtcampanas()->getId(),'regEstado'=>'REGISTRADO')),
        ]);
    }

    /**
     * @Route("/ventas", name="ct_registros_ventas", methods={"GET"})
     */
    public function ventas_index(CtRegistrosRepository $ctRegistrosRepository): Response
    {
        $user = $this->getUser();
        return $this->render('ct_registros/ventas.html.twig', [
            'ct_registros' => $ctRegistrosRepository->getRegistrosByUseraxis($user->getId(),'ASIGNADO'),
            //'ct_registros' => $ctRegistrosRepository->findBy(array('ctcampanas'=>$user->getCtcampanas()->getId(),'regEstado'=>'REGISTRADO')),
        ]);
    }

    /**
     * @Route("/supervisor", name="ct_registros_supervisor", methods={"GET"})
     */
    public function supervisor_index(CtRegistrosRepository $ctRegistrosRepository): Response
    {
        $user = $this->getUser();
        return $this->render('ct_registros/supervisor.html.twig', [
            'ct_registros' => $ctRegistrosRepository->getRegistrosByCampana($user->getCtcampanas()->getId(),'REGISTRADO'),
            'ct_asesores' => $ctRegistrosRepository->getAsesor($user->getCtcampanas()->getId()),
            //'ct_registros' => $ctRegistrosRepository->findBy(array('ctcampanas'=>$user->getCtcampanas()->getId(),'regEstado'=>'REGISTRADO')),
        ]);
    }

    /**
     * @Route("/", name="ct_registros_index", methods={"GET"})
     */
    public function index(CtRegistrosRepository $ctRegistrosRepository): Response
    {
        $user = $this->getUser();
        return $this->render('ct_registros/index.html.twig', [
            //'ct_registros' => $ctRegistrosRepository->findAll(),
            'ct_registros' => $ctRegistrosRepository->getRegistrosByAgente($user->getId()),
        ]);
    }

    /**
     * @Route("/new", name="ct_registros_new", methods={"GET","POST"})
     */
    public function new(Request $request, CtRegistrosRepository $ctRegistrosRepository): Response
    {
        $ctRegistro = new CtRegistros();
        $form = $this->createForm(CtRegistrosType::class, $ctRegistro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctRegistro);
            $entityManager->flush();

            return $this->redirectToRoute('ct_registros_index');
        }

        return $this->render('ct_registros/new.html.twig', [
            'ct_registro' => $ctRegistro,
            'ct_registros' => $ctRegistrosRepository->getAllRegistros(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_registros_show", methods={"GET"})
     */
    public function show(CtRegistros $ctRegistro): Response
    {
        return $this->render('ct_registros/show.html.twig', [
            'ct_registro' => $ctRegistro,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_registros_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtRegistros $ctRegistro, CtRegistrosRepository $ctRegistrosRepository): Response
    {
        $form = $this->createForm(CtRegistrosType::class, $ctRegistro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctRegistro->setRegEstado('ATENDIDO');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_registros_ventas', [
                'id' => $ctRegistro->getId(),
            ]);
        }

        return $this->render('ct_registros/edit.html.twig', [
            'ct_registro' => $ctRegistro,
            'ct_registros' => $ctRegistrosRepository->getEditRegistros($ctRegistro->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_registros_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtRegistros $ctRegistro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctRegistro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctRegistro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_registros_index');
    }
}
