<?php

namespace App\Form;

use App\Entity\Products\Coffee;
use App\Entity\Products\ProductComponents\Milk;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoffeeFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * Form for building Coffee entity, with form validation in the frontend.
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'milk',
                CheckboxType::class,
                [
                    'label' => 'Milk?',
                    'empty_data' => 0,
                    'required' => false,
                ]
            )
            ->add(
                'milkType',
                EntityType::class,
                [
                    'class' => Milk::class,
                    'empty_data' => null,
                ]
            )
            ->add('cupSize')
            ->add(
                'longitude',
                NumberType::class,
                [
                    'property_path' => 'location[0]',
                ]
            )
            ->add(
                'latitude',
                NumberType::class,
                [
                    'property_path' => 'location[1]',
                ]
            )
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
