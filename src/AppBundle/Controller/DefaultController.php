<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Selection\Selection;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DefaultController extends Controller
{
    private function echoForm(Array $list)
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
    * @Route("/", name="home")
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
