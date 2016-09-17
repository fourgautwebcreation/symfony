<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Selection\Selection;

class DefaultController extends Controller
{
    public function echoForm(Array $list)
    {
     $selection = new Selection();
     $array = $selection->setList($list);
     $form = $this->createFormBuilder()
            ->add('list', ChoiceType::class,
                  array('choices' => $array, 'label'  => false ,
                  'data' => '0'
                       )
                  )
            ->getForm();

     return $form;
    }


    /**
    * @Route("/")
    */

    public function indexAction()
    {
    $em = $this->getDoctrine()->getManager();
    $repository = $em->getRepository('AppBundle:Enterprises');
    $list = $repository->findAll();
    $form = DefaultController::echoForm($list);

    return $this->render('AppBundle:Default:index.html.twig',
                         array('form' => $form->createView(), 'enterprises'=>$list )
                        );
    }
}
