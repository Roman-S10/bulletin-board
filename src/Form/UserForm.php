<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', TextType::class)
            ->add('name', TextType::class)
            ->add('patronymic', TextType::class)
            ->add('birthDate', DateType::class,
                ['widget' => 'single_text', 'format' => 'dd.MM.yyyy',
                    'attr' =>
                        ['class' =>
                            'datepicker pull-right',
                            'data-provide' => 'datepicker',
                            'data-date-format' => 'dd.mm.yyyy']
                ]
            )
            ->add('email', EmailType::class)
            ->add('username', TextType::class)
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Пароль', 'attr' => ['class' => 'form-control']),
                'second_options' => array('label' => 'Поворите пароль', 'attr' => ['class' => 'form-control']),
            ))
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}