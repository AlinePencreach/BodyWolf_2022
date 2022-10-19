<?php

namespace App\Form;

use App\Entity\Salle;
use App\Entity\Permission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Veillez saisir votre Nom de salle. Ex: BodyWolf Le Vieux Port',
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
            ->add('adresse', TextareaType::class, [
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Veillez saisir une adresse pour la salle.',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'L\'adresse de la salle doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'required' => true,
            ])
            ->add('is_active', CheckboxType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veillez activer la salle avant de valider',
                    ]),
                ],
                'required' => false,
            ])
            ->add('structure')
            ->add('manager')
            // ->add('permissions')
            ->add('permissions', EntityType::class, [
                'class' => Permission::class,                
                'label' => 'Choisissez les options',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'choice_label' => 'titre',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'd-flex justify-content-between',
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salle::class,
        ]);
    }
}
