<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsertForm extends AbstractType
{

 public function configureOptions(OptionsResolver $resolver)
    {
    $resolver
        ->setDefault('select',null)
        ->setRequired('select')
        ->setAllowedTypes('select','array')
        ->setDefault('type',null)
        ->setRequired('type')
        ->setAllowedTypes('type','string')
        ->setDefaults(array(
        'data_class' => 'AppBundle\Entity\Enterprises'
        ));
        ;
    }

 public function buildForm(FormBuilderInterface $builder, array $options)
    {
     $select = $options['select'];
     $type = $options['type'];

     $builder->add('EnterpriseName', TextType::class,
           array(
            'label' => 'Nom',
            'attr' => array('name' => 'nom'),
            'required' => true,
            'invalid_message' => 'Le Nom ne doit pas être vide'
               )
           );
     $builder->add('EnterpriseAdress', TextType::class,
           array(
           'label' => 'Adresse',
           'required' => true,
           'invalid_message' => 'L\'adresse ne doit pas être vide'
              )
           );
     $builder->add('EnterpriseSiren', TextType::class,
           array(
            'label'=>'N° Siren',
            'attr' => array('minlength' => '9', 'maxlength' => '9'),
            'required' => true,
            'invalid_message' => 'Un numéro siren comporte 9 chiffres'
               )
           );
           $builder->add('EnterpriseSector', ChoiceType::class,
                 array(
                  'choices' => $select,
                  'label' => 'Secteur d\'activité',
                  'required' => true
                     )
                 );
     $builder->add('type', HiddenType::class, array('data' => $type, 'mapped'=>false));
    }

}
