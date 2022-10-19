<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
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
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Veillez saisir votre Prénom.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom de la salle doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Veillez saisir votre Nom.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom de la salle doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veillez saisir votre adresse e-mail',
                    ]),
                    new Email([
                        'message' => 'Veillez saisir une adresse e-mail correcte',
                    ])
                ],
                'required' => true,
            ])
            ->add('sujet', TextType::class, [
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Veillez saisir un objet pour votre message.',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Votre mobjet doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'required' => true,
            ])

            ->add('message', TextareaType::class, [
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Veillez saisir votre message.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre message doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
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
