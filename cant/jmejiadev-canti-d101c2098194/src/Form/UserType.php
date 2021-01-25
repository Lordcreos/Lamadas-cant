<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('enabled')
            ->add('usuNombres',null, array(
                'required' => true,
            ))
            ->add('usuApellidos',null, array(
                'required' => true,
            ))
            ->add('ctcampanas');

        $datos = $options['data']->getId();
        if($datos == null) {
            $builder
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'options' => array(
                        //'translation_domain' => 'messages',
                        'attr' => array(
                            'autocomplete' => 'new-password',
                            'class' => 'form-control form-control-sm',
                            'minlength'=>6,
                            'maxlength'=>15
                        ),
                    ),
                    'first_options' => array('label' => 'Contraseña (min:6 - max:15)', ),
                    'second_options' => array('label' => 'Confirmar Contraseña'),
                    //'invalid_message' => '{%trans%}Hola{% endtrans%}'
                ));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            //'translation_domain' => 'messages'
        ]);
    }
}
