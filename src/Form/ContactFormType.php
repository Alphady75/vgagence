<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' =>  'Nom',
                'attr'  =>  [
                    'placeholder'   =>  'Entrer votre nom', 
                    'class' => 'form-input js-pointer-small', 
                    'id' => 'first_name'
                ],
                'constraints'   =>  [
                    new NotBlank([
                        'message'   =>  'Entrer votre nom'
                    ])
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' =>  'Prénom',
                'attr'  =>  [
                    'placeholder'   =>  'Entrer votre prénom',
                    'class' => 'form-input js-pointer-small',
                    'id' => 'last_name'
                ],
                'constraints'   =>  [
                    new NotBlank([
                        'message'   =>  'Entrer votre prénom'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'label' =>  'Adresse e-mail',
                'attr'  =>  [
                    'placeholder' => "Adresse Email",
                    'class' => 'form-input js-pointer-small',
                    'id' => 'email'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre e-mail',
                    ]),
                    new Email([
                        'message' => 'Cette e-mail ne corespond pas à une adresse email valide' 
                    ])
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' =>  'Message',
                'attr'  =>  [
                    'placeholder'   =>  'Entrer votre message...',
                    'class' => 'form-input js-pointer-small',
                    'id' => 'message'
                ],
                'constraints'   =>  [
                    new NotBlank([
                        'message'   =>  'Veuillez écrire un message'
                    ]),
                    new Length([
                        'min'   =>  10,
                        'minMessage'    =>  'Votre message doit avoir au minimum 10 caractères',
                        'max'   =>  500,
                        'maxMessage'    =>  'Votre message doit avoir au maximum 500 caractères'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
