<?php

namespace AppBundle\Form;

use AppBundle\Entity\Department;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom',
                'attr' => array(
                'class' => 'form-control')
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nom',
                'attr' => array(
                    'class' => 'form-control')
            ))
            ->add('numEtud', TextType::class,  array(
                'label' => 'Numéro étudiant',
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 10)

            ))
            ->add('department', EntityType::class, array(
                'label' => 'Département',
                'attr' => array(
                    'class' => 'form-control'),
                'class' => Department::class,
                'choice_label' => 'name',
                'multiple'=> false,
                //'mapped' => false,

            ))
            ->add('submit', SubmitType::class, array(
            'label' => 'Valider'
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Student'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_student';
    }


}
