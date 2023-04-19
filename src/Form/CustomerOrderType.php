<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\CustomerOrder;
use App\Entity\OrderStatus;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateCustomerOrder', DateType::class, [
                'label' => 'Date commande'
            ])
            ->add('deliveryDateCustomerOrder', DateType::class, [
                'label' => 'Date de livraison'
            ])
            ->add('orderStatus', EntityType::class, [
                'class' => OrderStatus::class,
                'label' => 'Statut commande'
            ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'label' => 'Client'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomerOrder::class,
        ]);
    }
}
