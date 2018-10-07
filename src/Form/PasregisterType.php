<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class PasregisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('confirm_password',PasswordType::class)
            ->add('roles',ChoiceType::class,[
              'multiple' => true,
              'expanded' => true,
              'choices' => [
                'PASSENGER' => 'ROLE_PASSENGER',
              ]
            ])
            // ->add('roles',TextType::class, array(
            //   'data' => ['ROLE_PASSENGER'],
            // )
            // )
            // ->add('roles',HiddenType::class, array(
            //   'required'   => false,
            //   'data' => 'ROLE_PASSENGER',
            // )
            // )

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
