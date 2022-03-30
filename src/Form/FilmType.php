<?php

namespace App\Form;

use App\Entity\Film;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,
                ['label' => 'Titre du film', 'attr' => ['placeholder' => 'Titre']])
            ->add('annee', IntegerType::class,
                ['label' => 'Année de sortie'])
            ->add('enstock', ChoiceType::class,
                ['label' => 'En stock ?', 'choices' => ['Oui' => true, 'Non' => false], 'expanded' => true])
            ->add('prix', NumberType::class,
                ['label' => 'Prix d\'achat'])
            ->add('quantite', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
