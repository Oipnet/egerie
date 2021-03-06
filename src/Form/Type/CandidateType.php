<?php

namespace App\Form\Type;

use App\Entity\Candidate;
use App\Entity\Eye;
use App\Entity\Hair;
use App\Entity\Language;
use App\Repository\CandidateRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('language', EntityType::class, [
                'class' =>  Language::class,
                'choice_value' => function(Language $language = null) {
                    return $language ? $language->getShortCode(): '';
                }
            ])
            ->add('eye', EntityType::class, [
                'class' =>  Eye::class,
                'choice_value' => function(Eye $eye = null) {
                    return $eye ? $eye->getShortCode(): '';
                }
            ])
            ->add('hair', EntityType::class, [
                'class' =>  Hair::class,
                'choice_value' => function(Hair $hair = null) {
                    return $hair ? $hair->getShortCode(): '';
                }
            ])
            ->add('size', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Taille'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'A propos de moi',
                'attr' => [
                    'placeholder' => 'A propos de moi',
                    'rows' => 15
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Candidate::class,
        ]);
    }
}
