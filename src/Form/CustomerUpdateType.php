<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'label_attr' => ['class' => 'mt-4'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'label_attr' => ['class' => 'mt-4'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'label_attr' => ['class' => 'mt-4'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'label_attr' => ['class' => 'mt-4'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'label_attr' => ['class' => 'mt-4'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('zipcode', NumberType::class, [
                'label' => 'Code postal',
                'label_attr' => ['class' => 'mt-4'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'label_attr' => ['class' => 'mt-4'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
