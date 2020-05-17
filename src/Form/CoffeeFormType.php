<?php

namespace App\Form;

use App\Entity\Products\Coffee;
use App\Entity\Products\ProductComponents\Milk;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoffeeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('milk', CheckboxType::class,[
                'label' => 'Milk?',
                'empty_data'=>0,
                'required'=>false
            ])
            ->add(
                'milkType',
                EntityType::class,
                [
                    'class' => Milk::class,
                    'empty_data'=>null
                ]
            )
            ->add('cupSize')
            ->add('Longitude', TextType::class, [
                'property_path'=> 'location[0]'
            ])
            ->add('Latitude', TextType::class, [
                'property_path'=> 'location[1]'
            ])
            ->add(
                'sendJSON',
                SubmitType::class,
                [
                    'label' => 'Send in JSON',
                ]
            )
            ->add(
                'sendXML',
                SubmitType::class,
                [
                    'label' => 'Send in XML',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Coffee::class,
            ]
        );
    }
}
