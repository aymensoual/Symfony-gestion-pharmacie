<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\RoleType;
use UserBundle\Entity\User;

class UserController extends Controller {

    public function indexAction() {
        $user = new user();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findAll();
        return $this->render('UserBundle:User:index.html.twig', array('user' => $user
        ));
    }

   
    
    
    public function enabledAction(User $user) {
        $em = $this->getDoctrine()->getManager();

        if ($user->isEnabled()) {
            $user->setEnabled(0);
        } else {
            $user->setEnabled(1);
        }
        $em->persist($user);
        $em->flush();



        return $this->redirect($this->generateUrl('index2'));
        // ...
    }

    public function deleteAction(User $user) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateUrl('index2'));
    }

    public function roleAction(Request $request ,$token) 
            {
        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findOneByToken($token);
        $form = $this->createForm(new RoleType());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $role = $data['role'];
            $user->setRoles(array($role));
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('index2');
        }
        

        return $this->render('UserBundle:User:role.html.twig', array('form' => $form->createView()
                        // ...
        ));
    }

}
