<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use AppBundle\Forms\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
