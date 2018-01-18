<?php

namespace App\Form;

use App\Entity\Announcement;
use App\Entity\Area;
use App\Entity\City;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncementForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area', EntityType::class,[ 'class' => Area::class,'choice_label' => 'name',])
            ->add('city', EntityType::class,[ 'class' => City::class,'choice_label' => 'name',])
            ->add('category', EntityType::class,[ 'class' => Category::class,'choice_label' => 'name',])
            ->add('title')
            ->add('description')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($builder)
        {
            $data = $event->getData();

            $event->getForm()->add('save', SubmitType::class, array(
                'label' => $data && $data->getId() ? 'Сохранить' : 'Добавить',
            ));
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Announcement::class,
        ));
    }
}