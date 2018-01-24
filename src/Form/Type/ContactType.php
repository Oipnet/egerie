<?php

namespace App\Form\Type;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom'
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
            ->add('subject', TextType::class, [
                'attr' => [
                    'placeholder' => 'Sujet'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'rows' => 8
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Contact::class,
        ]);
    }
}
