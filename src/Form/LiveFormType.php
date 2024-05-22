<?php

// src/Form/LiveFormType.php
namespace App\Form;

use App\Entity\Live;
use App\Entity\Streamer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LiveFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du live'
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Date du live'
            ])
            ->add('streamer', EntityType::class, [
                'class' => Streamer::class,
                'choice_label' => 'name', // Assumez que la propriété 'name' existe dans l'entité Streamer
                'label' => 'Streamer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Live::class,
        ]);
    }
}
