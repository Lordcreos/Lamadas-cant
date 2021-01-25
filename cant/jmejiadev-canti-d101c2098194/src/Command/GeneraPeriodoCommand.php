<?php

namespace App\Command;

use App\Entity\BtPerHorPer;
use App\Entity\BtPeriodos;
use App\Entity\BtPersonal;
use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\BtPeriodosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;


class GeneraPeriodoCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'app:genera-periodo';
    private $entityManager;
    private $mailer;
    private $twig;

    public function __construct( EntityManagerInterface $entityManager, \Swift_Mailer $mailer, Environment $twig)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    protected function configure()
    {

        $this
            ->setDescription('Genera periodos diarios')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $fecha = new \Datetime('now');
        $em = $this->getContainer()->get('doctrine')->getManager();
        $periodo = $em->getRepository(BtPeriodos::class)->findBy(array('perFecha'=>$fecha->format('Y-m-d')));
        if(!$periodo) {
            try {

                $btPeriodo = new BtPeriodos();
                $btPeriodo->setPerEstado('INICIAL');
                $btPeriodo->setPerFecUpdate($fecha);
                $btPeriodo->setPerFecha($fecha->format('Y-m-d'));
                $btPeriodo->setPerObservaciones("Creado correctamente");
                $em->persist($btPeriodo);
                $em->flush();

                //GENERA EL HORARIO PARA CADA PERSONAL  QUEMADO
                $diaNombre = ['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
                $diaIndex = date("w", strtotime($btPeriodo->getPerFecha())) -1;

                $personal = $em->getRepository(BtPersonal::class)->findAll();

                foreach ($personal as $persona){
                    $perhorper = new BtPerHorPer();
                    $perhorper->setBtperiodos($btPeriodo);
                    $perhorper->setBtpersonal($persona);
                    if ($diaNombre[$diaIndex] == 'Lunes') {
                        $horid = $persona->getPerHorLunes();
                    } else {
                        if ($diaNombre[$diaIndex] == 'Martes') {
                            $horid = $persona->getPerHorMartes();
                        } else {
                            if ($diaNombre[$diaIndex] == 'Miercoles') {
                                $horid = $persona->getPerHorMiercoles();
                            } else {
                                if ($diaNombre[$diaIndex] == 'Jueves') {
                                    $horid = $persona->getPerHorJueves();
                                } else {
                                    if ($diaNombre[$diaIndex] == 'Viernes') {
                                        $horid = $persona->getPerHorViernes();
                                    } else {
                                        if ($diaNombre[$diaIndex] == 'Sabado') {
                                            $horid = $persona->getPerHorSabado();
                                        } else {
                                            if ($diaNombre[$diaIndex] == 'Domingo') {
                                                $horid = $persona->getPerHorDomingo();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $perhorper->setHorario($horid);
                    $em->persist($perhorper);
                }
                $em->flush();
                $response = "Periodo: ".$fecha->format('Y-m-d') . " Creado correctamente";

            } catch (\Exception $e) {
                $response = $e->getMessage();
            }
        }else{
            $response = 'Periodo ya existe';
        }

        $message = (new \Swift_Message('Creación de periodo: '))
            ->setFrom('info@gsicore.com','Gestión de Soluciones Informáticas')
            ->setTo('jaimemejiar1980@gmail.com','Jaime Mejia')
            ->setBody($response,
                'text/html'
            );

        try {
            $this->mailer->send($message);

        } catch (\Exception $e) {
            $response = $e->getMessage();
        }


        $io->success($response);
    }
}
