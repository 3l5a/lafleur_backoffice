<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstNameCustomer', TextType::class, [
                'label' => 'Statut commande'
            ])
            ->add('lastNameCustomer', TextType::class, [
                'label' => 'Statut commande'
            ])
            ->add('emailCustomer', TextType::class, [
                'label' => 'Statut commande'
            ])
            ->add('passwordCustomer', TextType::class, [
                'label' => 'Statut commande'
            ])
            ->add('role', TextType::class, [
                'label' => 'Rôle'
            ])
            ->add('address', EntityType::class, [
                'class' => Address::class,
                'label' => 'Adresse(s)'
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
