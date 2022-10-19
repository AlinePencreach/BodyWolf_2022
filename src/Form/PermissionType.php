<?php

namespace App\Form;

use App\Entity\Permission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PermissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Veillez saisir un titre pour cette option. Ex: Newsletters',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Le nom de la salle doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Veillez saisir une description pour cette option.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le nom de la salle doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'required' => true,
            ])
            
            ->add('is_active', CheckboxType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veillez activer l\'option avant de valider',
                    ]),
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Permission::class,
        ]);
    }
}
