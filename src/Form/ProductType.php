<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\SuppliedItem;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameProduct', TextType::class, [
                'label' => 'Article'
            ])
            ->add('descriptionProduct', TextType::class, [
                'label' => 'Description'
            ])
            ->add('imageProduct', TextType::class, [
                'label' => 'Image',
                'required' => false,
            ])
            ->add('priceProduct', TextType::class, [
                'label' => 'Prix'
            ])
            ->add('quantityProduct', TextType::class, [
                'label' => 'Quantité en stock'
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Catégorie(s)',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('suppliedItem', EntityType::class, [
                'class' => SuppliedItem::class,
                'multiple' => true,
                'label' => 'Composition de l\'article',
                'expanded' => true,

                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('suppliedItem')
                        ->orderBy('suppliedItem.id', 'DESC');
                },
                'choice_label' => function ($suppliedItem) {
                    return $suppliedItem->getNameSuppliedItem();
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
