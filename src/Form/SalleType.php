<?php

namespace App\Form;

use App\Entity\Salle;
use App\Entity\Permission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
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
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('adresse', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('is_active', CheckboxType::class, [
                'attr' => ['class' => 'checkbox'],
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
