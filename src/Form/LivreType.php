<?php

namespace App\Form;

use App\Entity\Livres;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('isbn')
            ->add('slug')
            ->add('auteur')
            ->add('image')
            ->add('resume')
            ->add('editeur')
            ->add('dateEdition')
            ->add('prix')
            ->add('qte')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
'choice_label' => 'libelle',

            ])
            ->add('Enregistrer',SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livres::class,
        ]);
    }
}
