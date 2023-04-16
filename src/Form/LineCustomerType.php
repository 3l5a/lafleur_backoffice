<?php

namespace App\Form;

use App\Entity\CustomerOrder;
use App\Entity\LineCustomer;
use App\Entity\Prize;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LineCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantityLineCustomer')
            ->add('prize', EntityType::class, [
                'class' => Prize::class,
                'label' => 'Prix lotterie'
            ])
            ->add('customerOrder', EntityType::class, [
                'class' => CustomerOrder::class,
                'label' => 'N° de commande'
            ])
            ->add('product')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LineCustomer::class,
        ]);
    }
}
