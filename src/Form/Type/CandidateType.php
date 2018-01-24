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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('last_name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'E-mail'
                ]
            ])
            ->add('phone', TextType::class, [
                'attr' => [
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('zip_code', TextType::class, [
                'attr' => [
                    'placeholder' => 'Code Postal'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('birth_date', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'onfocus'   => '(this.type=\'date\')',
                    'onblur'    => '(this.type=\'text\')',
                    'placeholder' => 'Date de naissance',
                ]
            ])
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
            ->add('cgu', CheckboxType::class, [
                'label'    => 'En cochant cette case, je reconnais avoir pris connaissance des Conditions Générales d’Utilisation du site et du Règlement du Casting et je les accepte.',
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
