<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateForm extends AbstractType
{

 public function configureOptions(OptionsResolver $resolver)
    {
    $resolver
         ->setDefaults(array(
         'data_class' => 'AppBundle\Entity\Enterprises',
         'select' => null,
         'id' => null
         ))
        ->setRequired(array('select','type','id'))
        ->setAllowedTypes('select','array')
        ->setAllowedTypes('type','string')
        ->setAllowedTypes('id','int')
        ;
    }

 public function buildForm(FormBuilderInterface $builder, array $options)
    {
     $select = $options['select'];
     $id = $options['id'];
     $type = $options['type'];

     $builder->add('EnterpriseName', TextType::class,
           array(
            'label' => 'Nom',
            'attr' => array('name' => 'nom'),
            'required' => true
               )
           );
     $builder->add('EnterpriseAdress', TextType::class,
           array(
           'label' => 'Adresse',
           'required' => true
              )
           );
     $builder->add('EnterpriseSiren', TextType::class,
           array(
            'label'=>'N° Siren',
            'attr' => array('minlength' => '9'),
            'required' => true
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
     $builder->add('id', HiddenType::class, array('data' => $id ));
    }

}
