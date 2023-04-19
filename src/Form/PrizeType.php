<?php

namespace App\Form;

use App\Entity\Prize;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrizeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('namePrize', TextType::class, [
                'label' => 'Nom du lot'
            ])
            ->add('quantityPrize', TextType::class, [
                'label' => 'Quantité'
            ])
            ->add('descriptionPrize', TextType::class, [
                'label' => 'Description'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prize::class,
        ]);
    }
}
