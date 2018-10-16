<?php

namespace App\Form;

use App\Entity\Volfake;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('volnum')
            ->add('ville')
            ->add('arrive')
            ->add('depart')
            ->add('pilote')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Volfake::class,
        ]);
    }
}
