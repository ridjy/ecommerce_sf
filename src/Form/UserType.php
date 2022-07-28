<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
//ajout du use pour utiliser le type input password de Symfony
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class,array(
                'label' => 'Vorname',
                'attr' => array(
                    'placeholder' => 'Votre pseudo')))
            ->add('email',EmailType::class,array(
                'label' => 'Vormail',
                'attr' => array(
                    'placeholder' => 'Votre adresse mail')))
            //->add('roles') //à ajouter par defaut
            ->add('password', PasswordType::class,array(
                'label' => 'Vormdp',
                'attr' => array(
                    'placeholder' => 'Votre mot de passe')))
        ;
        /*$builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesAsArray) {
                    return count($rolesAsArray) ? $rolesAsArray[0]: null;
                },
                function ($rolesAsString) {
                    return [$rolesAsString];
                }
        ));*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
