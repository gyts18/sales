<?php

namespace App\Form;

use App\Entity\Products\Flowers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlowerFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * Form for building Flowers entity, with form validation in the frontend.
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add(
                'street',
                TextType::class,
                [
                    'property_path' => 'address[0]',
                ]
            )
            ->add(
                'street_number',
                IntegerType::class,
                [
                    'property_path' => 'address[1]',
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'property_path' => 'address[2]',
                ]
            )
            ->add(
                'country',
                TextType::class,
                [
                    'property_path' => 'address[3]',
                ]
            )
            ->add(
                'deliver_on',
                DateTimeType::class,
                [
                    'data' => new \DateTime('now'),
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
                'data_class' => Flowers::class,
            ]
        );
    }
}
