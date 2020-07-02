<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Voiture;
use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('type')
            ->add('annee')
            ->add('carburant')
            ->add('prix')
            ->add('couleur',ColorType::class)
            ->add('kilometrage')
            ->add('dedouaner')
            ->add('personne',EntityType::class, [
                'class' => Personne::class,
                'choice_label' => function($personne){
                    return $personne->getPrenom()." ".$personne->getNom();
                },
            ]) 
            ->add('pays',EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'libele',
                'label'        => 'Pays',
                'expanded'     => true,
                'multiple'     => true,                           
            ])
         ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
