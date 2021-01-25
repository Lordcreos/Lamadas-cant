<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class DefaultController extends AbstractController
{
    /**
     * @Route({
     *     "en": "/",
     *     "es": "/"
     * }, name="home")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (is_object($user)) {
            if($user->getRoles()[0] == 'SUPERVISOR') {
                return $this->redirectToRoute('ct_registros_supervisor');
            }else{
                if($user->getRoles()[0] == 'AGENTE') {
                    return $this->redirectToRoute('ct_registros_index');
                }else {
                    if($user->getRoles()[0] == 'VENTAS') {
                        return $this->redirectToRoute('ct_registros_ventas');
                    }else {
                        if($user->getRoles()[0] == 'REPORTERIA') {
                            return $this->redirectToRoute('ct_registros_reporteria_gestion');
                        }else {
                            return $this->redirectToRoute('user_index');
                        }
                    }
                }
            }
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

    /** Cambia el idioma
     * @Route("/cambia-idioma", name="default_cambia_idioma", methods={"POST"})
     */
    public function cambiaIdioma(Request $request)
    {
        $lang = $_POST['lang'];
        $route = $_POST['route'];
        return $this->redirectToRoute($route,['_locale'=>$lang]);
    }
}
