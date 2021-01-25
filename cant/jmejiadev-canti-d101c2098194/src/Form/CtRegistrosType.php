<?php

namespace App\Form;

use App\Entity\CtRegistros;
use App\Entity\CtCampanas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CtRegistrosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $datos = $options['data']->getId();
        if($datos == null) {
            $builder
                ->add('regDocumento')
                ->add('regTelefono')
                ->add('regNombre')
                ->add('regProducto')
                ->add('regFecRegistro', DateType::class, array(
                    'data' => new \DateTime('now'),
                    'format' => 'yyyy-MM-dd',
                    'widget' => 'single_text',
                ))
                ->add('regEstado')
                ->add('ctcampanas')
                ->add('cttipllamadas')
                ->add('userntg');

        }else {
            $builder
                ->add('regDocumento')
                ->add('regTelefono')
                ->add('regNombre')
                ->add('regProducto')
                ->add('regTipGestion',ChoiceType::class,array(
                    'choices'  => [
                        'VENTA' => 'VENTA',
                        'NO VENTA' => 'NO VENTA',
                        'VOLVER A LLAMAR' => 'VOLVER A LLAMAR',
                        'OTRO' => 'OTRO',
                    ],
                ))
                ->add('obsOtrCampana',EntityType::class, array(
                    'class'=> CtCampanas::class,
                    'placeholder' => 'Seleccione una Opción'
                ))
                ->add('regFecRegistro', DateType::class, array(
                    'format' => 'yyyy-MM-dd',
                    'widget' => 'single_text',
                ))
                ->add('regFecGestion', DateType::class, array(
                    'data' => new \DateTime('now'),
                    'format' => 'yyyy-MM-dd',
                    'widget' => 'single_text',
                ))
                ->add('regEstado')
                ->add('ctcampanas')
                ->add('cttipllamadas')
                ->add('userntg')
                ->add('useraxis');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtRegistros::class,
        ]);
    }
}
