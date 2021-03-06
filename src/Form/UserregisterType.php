<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class UserregisterType extends AbstractType
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
                'PILOTE' => 'ROLE_PILOTE',
                'ADMIN' => 'ROLE_ADMIN',
              ]
            ])
            // ->add('submit', SubmitType::class,[
            //   'attr' => [
            //     'class' => 'btn btn-success pull-right'
            //   ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
