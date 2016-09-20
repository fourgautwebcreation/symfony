<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeleteForm extends AbstractType
{

 public function configureOptions(OptionsResolver $resolver)
    {
     $resolver
     ->setDefaults(array(
     'data_class' => 'AppBundle\Entity\Enterprises',
     'type' => null,
     'id' => null,
     'attr' => array('action' => 'delete')
     ))
    ->setRequired(array('type','id'))
    ->setAllowedTypes('type','string')
    ->setAllowedTypes('id','int')
    ;
    }

 public function buildForm(FormBuilderInterface $builder, array $options)
    {
     $type = $options['type'];
     $id = $options['id'];
     $builder->add('type', HiddenType::class, array('data' => $type, 'mapped'=>false));
     $builder->add('id', HiddenType::class, array('data' => $id, 'mapped'=>false));
    }

}
