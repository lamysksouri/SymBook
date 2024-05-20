<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\OrderItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etat', TextType::class, [
                'label' => 'État',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de la commande',
            ])
            ->add('item', EntityType::class, [
                'class' => OrderItem::class,
                'choice_label' => 'id', // Or another field that makes sense as a label
                'label' => 'Item de commande',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
