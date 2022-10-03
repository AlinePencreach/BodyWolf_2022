<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('sujet', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])

            ->add('message', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
