<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Enterprises;
use AppBundle\Form\Type as Forms;

class AdminController extends Controller
{

 public $errors;
 public $select;
 public $forms;

  // Création de la liste des secteurs disponibles
  private function createListSectors()
  {
   $select = array();
   $em = $this->getDoctrine()->getManager();
   $repository = $em->getRepository('AppBundle:Sectors');
   $list = $repository->findAll();
   foreach($list as $list)
   {
    $select[$list->sectorName] = $list->id;
   }
   $this->select = $select;
  }

  // Update d'une entreprise
  private function updateEnterprise($datas)
  {
   $em = $this->getDoctrine()->getManager();
   $sector = $em->getRepository('AppBundle:Sectors')->find($datas->enterpriseSector);
   $datas->setEnterpriseSectorName($sector);

   $em = $this->getDoctrine()->getManager();
   $em->persist($datas);
   $em->flush();
  }

  //Création du formulaire d'insertion d'une entreprise
  private function createInsert($request)
  {
   $enterprise = new Enterprises();
   $enterprise->setEnterpriseName('');
   $enterprise->setEnterpriseAdress('');
   $enterprise->setEnterpriseSiren('');
   $enterprise->setEnterpriseSector('1');
   $form = $this->createForm(Forms\InsertForm::class,
             $enterprise,
             array('select' => $this->select, 'type' => 'create')
           );
   $form->handleRequest($request);

    if ($form->isValid()) {
     $datas = $form->getData();
     if($form->get('type')->getData() == 'create') {
      $em = $this->getDoctrine()->getManager();
      $sector = $em->getRepository('AppBundle:Sectors')->find($datas->enterpriseSector);
      $datas->setEnterpriseSectorName($sector);

      $em = $this->getDoctrine()->getManager();
      $em->persist($datas);
      $em->flush();
      unset($enterprise);
      unset($form);
      $enterprise = new Enterprises();
      $form = $this->createForm(Forms\InsertForm::class,
                $enterprise,
                array('select' => $this->select, 'type' => 'create')
              );
     }
    }

   return $form->createView();
  }

  //Création des formulaires de modification des entreprises
  private function createForms($request)
  {
   $em = $this->getDoctrine()->getManager();
   $repository = $em->getRepository('AppBundle:Enterprises');
   $list = $repository->findAll();
   $i = 0;
   $forms = array();
   foreach($list as $enterprises)
   {
    $form =  $this->get('form.factory')->createNamed('entreprise'.$enterprises->id,Forms\UpdateForm::class,
              $enterprises,
              array('select' => $this->select, 'id' => intval($enterprises->id), 'type' => 'update')
            );
    $form->handleRequest($request);
    //update
    if ($form->isValid()) {
     $datas = $form->getData();
     self::updateEnterprise($datas);
    }
    $forms[$i]['update'] = $form->createView();


    $delete = $this->get('form.factory')->createNamed('delete_enterprise',Forms\DeleteForm::class,
              $enterprises,
              array('type' => 'delete',  'id' => intval($enterprises->id))
            );
     $forms[$i]['delete'] = $delete->createView();
     $i++;
   }
   $this->forms = $forms;
  }

  /**
  * @Route("/admin/", name="admin")
  */

   public function indexAction(Request $request)
   {
      self::createListSectors();
      $insert = self::createInsert($request);
      self::createForms($request);
      return $this->render('AppBundle:Default:admin.html.twig',
                      array('insert' => $insert, 'forms' => $this->forms,'errors' => $this->errors)
                          );
   }
}
