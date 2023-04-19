<?php

namespace App\Form;

use App\Entity\Measurement;
use App\Entity\SuppliedItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SuppliedItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameSuppliedItem', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('descriptionSuppliedItem', TextType::class, [
                'label' => 'Description'
            ])
            ->add('priceSuppliedItem', TextType::class, [
                'label' => 'Prix d\'achat HT'
            ])
            ->add('color', ChoiceType::class, [
                'class' => Color::class,
                'label' => 'Couleur(s)'
            ])
            ->add('measurement', EntityType::class, [
                'class' => Measurement::class,
                'label' => 'Unité de mesure'
            ])
            // ->add('supplierOrder', ChoiceType::class, [
            //     'label' => 'N° de commande',
            //     'choice_data'
            // ])
            // ->add('product', EntityType::class, [
            //     'class' => Product::class,
            //     'label' => 'Articles concernés'
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SuppliedItem::class,
        ]);
    }
}
