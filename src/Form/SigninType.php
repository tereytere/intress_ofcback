<?php

namespace App\Form;

use App\Entity\Signin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SigninType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('timestart')
            ->add('timestop')
            ->add('timefinish')
            ->add('hourcount')
            ->add('personal')
            ->add('holidays')
            ->add('workshops')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Signin::class,
        ]);
    }
}
