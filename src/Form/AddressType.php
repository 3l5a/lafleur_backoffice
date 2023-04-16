<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('line1Adress', TextType::class, [
                'label' => 'Ligne 1'
            ])
            ->add('line2Adress', TextType::class, [
                'label' => 'Ligne 2',
                'required' => false
            ])
            ->add('city', EntityType::class, [
                'class' => City::class,
                'label' => 'Ville'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
