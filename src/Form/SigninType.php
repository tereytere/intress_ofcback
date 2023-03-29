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
            ->add('holidays')
            ->add('workshops')
            ->add('user')
            ->add('timeStart')
            ->add('timeStop')
            ->add('timeFinish')
            ->add('hourCount')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Signin::class,
        ]);
    }
}
