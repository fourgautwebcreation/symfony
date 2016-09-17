<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Enterprises;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminController extends Controller
{

 public $errors;

  // Création de la liste des secteurs disponibles
  private function createList()
  {
   $select = array();
   $em = $this->getDoctrine()->getManager();
   $repository = $em->getRepository('AppBundle:Sectors');
   $list = $repository->findAll();
   foreach($list as $list)
   {
    $select[$list->sectorName] = $list->id;
   }
   return $select;
  }

  //Création d'une entreprise
  private function createAction($datas)
  {
  $enterprise = new Enterprises();
  $enterprise->setEnterpriseName($datas['nom']);
  $enterprise->setEnterpriseSiren($datas['siren']);
  $enterprise->setEnterpriseAdress($datas['adress']);
  $enterprise->setEnterpriseSector(intval($datas['sector']));

  //récupération du nom du secteur concerné
  $em = $this->getDoctrine()->getManager();
  $sector = $em->getRepository('AppBundle:Sectors')->find($datas['sector']);
  $enterprise->setEnterpriseSectorName($sector);

  $em = $this->getDoctrine()->getManager();
  $em->persist($enterprise);
  $em->flush();

  //redirection
  $url = $this->get('router')->generate('admin');
  header('location:'.$url);
  exit;
  }

  //Update d'une entreprise
  private function updateAction($id,$datas)
  {
   $em = $this->getDoctrine()->getManager();
   $enterprise = $em->getRepository('AppBundle:Enterprises')->find($id);

    if (!$enterprise) {
        throw $this->createNotFoundException(
            'Aucune entreprise ne correspond à l\'identifiant  '.$id
        );
    }

   $enterprise->setEnterpriseName($datas['nom']);
   $enterprise->setEnterpriseSiren($datas['siren']);
   $enterprise->setEnterpriseAdress($datas['adress']);
   $enterprise->setEnterpriseSector($datas['sector']);

   //validation des champs
   $validator = $this->get('validator');
   $errors = $validator->validate($enterprise);
   if (count($errors) > 0) {
    $this->errors = $errors;
   }
   else {
    $em = $this->getDoctrine()->getManager();
    $em->persist($enterprise);
    $em->flush();

    //redirection
    $url = $this->get('router')->generate('admin');
    header('location:'.$url);
    exit;
    }
  }

  //Suppression d'une entreprise
  private function deleteAction($id)
  {
   $em = $this->getDoctrine()->getManager();
   $enterprise = $em->getRepository('AppBundle:Enterprises')->find($id);
   if (!$enterprise) {
    throw $this->createNotFoundException(
     'Aucune entreprise ne correspond à l\'identifiant  '.$id
    );
   }
   $em->remove($enterprise);
   $em->flush();

   //redirection
   $url = $this->get('router')->generate('admin');
   header('location:'.$url);
   exit;
  }

  /**
  * @Route("/admin/", name="admin")
  */

   public function indexAction(Request $request)
   {
      $select = AdminController::createList();
      $insert = self::createInsert($request,$select);
      $forms = AdminController::createForms($request,$select);
      return $this->render('AppBundle:Default:admin.html.twig',
                      array('insert' => $insert, 'forms' => $forms,'errors' => $this->errors)
                          );
   }

  //Création du formulaire d'insertion d'une entreprise
  private function createInsert($request,$select)
  {
   $form = $this->createFormBuilder(null,
                  array('attr' => array( 'class' => 'form_insert_enterprise'))
                  )
          ->add('nom', TextType::class,
                array(
                 'label' => 'Nom',
                 'attr' => array('name' => 'nom'),
                 'required' => true
                    )
                )
          ->add('adress', TextType::class,
                array(
                'label' => 'Adresse',
                'required' => true
                   )
                )
          ->add('siren', TextType::class,
                array(
                 'label'=>'N° Siren',
                 'attr' => array('minlength' => '9'),
                 'required' => true
                    )
                )
          ->add('sector', ChoiceType::class,
                array(
                 'choices' => $select,
                 'label' => 'Secteur d\'activité',
                 'required' => true,
                 'data' => '1'
                    )
                )
          ->add('action', HiddenType::class,
                array('data' => 'create')
                )
          ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
          ->getForm();
   $form->handleRequest($request);

   if ($form->isValid()) {
    $datas = $form->getData();
    if($datas['action'] == 'create') {
     self::createAction($datas);
    }
   }
   return $form->createView();
  }

  //Création des formulaires de modification des entreprises
  private function createForms($request,$select)
  {
   $em = $this->getDoctrine()->getManager();
   $repository = $em->getRepository('AppBundle:Enterprises');
   $list = $repository->findAll();
   $i = 0;
   $forms = array();
   foreach($list as $enterprise)
   {
    $form = $this->createFormBuilder(null, array('attr' => array( 'class' => 'form_enterprise','id' => 'enterprise'.$enterprise->id, 'name' => 'enterprise'.$enterprise->id)))
           ->add('nom', TextType::class,
                 array(
                  'data' => $enterprise->enterpriseName,
                  'label' => 'Nom',
                  'attr' => array('name' => 'nom'),
                  'required' => true
                     )
                 )
           ->add('adress', TextType::class,
                 array(
                  'data' => $enterprise->enterpriseAdress,
                 'label' => 'Adresse',
                 'required' => true
                    )
                 )
           ->add('siren', TextType::class,
                 array(
                  'data' => $enterprise->enterpriseSiren,
                  'label'=>'N° Siren',
                  'attr' => array('minlength' => '9'),
                  'required' => true
                     )
                 )
           ->add('sector', ChoiceType::class,
                 array(
                  'choices' => $select,
                  'data' => $enterprise->enterpriseSector,
                  'label' => 'Secteur d\'activité',
                  'required' => true
                     )
                 )
           ->add('id', HiddenType::class,
                 array('data' => $enterprise->id)
                 )
           ->add('action', HiddenType::class,
                 array('data' => 'update')
                 )
           ->getForm();
           $form->handleRequest($request);
           if ($form->isValid()) {
            $datas = $form->getData();
            if($datas['action'] == 'update') {
             self::updateAction($datas['id'], $datas);
            }
           }

    $delete = $this->createFormBuilder(null,
               array('attr' => array( 'class' => 'delete_enterprise',
               'id' => 'delete_enterprise'.$enterprise->id,
               'name' => 'delete_enterprise'.$enterprise->id)
                )
               )
    ->add('id', HiddenType::class,
          array('data' => $enterprise->id)
         )
    ->add('action', HiddenType::class,
          array('data' => 'delete')
    )
    ->getForm();
    $delete->handleRequest($request);
    if ($delete->isValid()) {
     $datas = $delete->getData();
     if($datas['action'] == 'delete') {
      self::deleteAction($datas['id']);
     }
    }
    $forms[$i]['delete'] = $delete->createView();
    $forms[$i]['update'] = $form->createView();
    $i++;
   }
   return $forms;
  }
}
