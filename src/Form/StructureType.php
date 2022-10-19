<?php

namespace App\Form;

use App\Entity\Structure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'constraints' =>[
                new NotBlank([
                    'message' => 'Veillez saisir le nom de la structure. Ex: BodyWolf Marseille',
                ]),
                new Length([
                    'min' => 10,
                    'minMessage' => 'Le nom de la structure doit contenir au moins {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 255,
                ]),
            ],
            'required' => true,
        ])
        ->add('partner'
        ) 
        ->add('is_active', CheckboxType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Veillez activer la structure avant de valider',
                ]),
            ],
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
