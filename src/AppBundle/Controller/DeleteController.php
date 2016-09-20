<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Enterprises;

class DeleteController extends Controller
{
 /**
 *@Route("/admin/delete", name="delete")
 */

 public function indexAction(Request $request)
 {
  if ($request->getMethod() == 'POST') {
      if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
       $datas = $request->get('delete_enterprise');
       $em = $this->getDoctrine()->getManager();
       $enterprise = $em->getRepository('AppBundle:Enterprises')->find($datas['id']);
       $em->remove($enterprise);
       $em->flush();
       //redirection
       return $this->redirectToRoute('admin',array(),301);
      }
  }
 }
}
