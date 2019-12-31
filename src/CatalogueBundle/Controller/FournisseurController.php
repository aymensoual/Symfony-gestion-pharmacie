<?php

namespace CatalogueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CatalogueBundle\Entity\Fournisseur;
use CatalogueBundle\Form\FournisseurType;
use CatalogueBundle\Form\RechercheType;

class FournisseurController extends Controller {

    public function indexAction() {
        $fournisseur = new Fournisseur();
        $em = $this->getDoctrine()->getManager();
        $fournisseur = $em->getRepository('CatalogueBundle:Fournisseur')->findAll();

        return $this->render('CatalogueBundle:Fournisseur:index.html.twig', array('fournisseur' => $fournisseur
                        // ...
        ));
    }

    public function newAction(Request $request) {

        $fournisseur = new Fournisseur;
        $form_ajout = $this->createForm(new FournisseurType(), $fournisseur);
        if ($request->isMethod('post')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fournisseur);
                $em->flush();
                return $this->redirectToRoute('index4');
            }
        }

        return $this->render('CatalogueBundle:Fournisseur:new.html.twig', array('form' => $form_ajout->createView()
                        // ...
        ));
    }

    public function editAction(Request $request, $token) {

        $em = $this->getDoctrine()->getManager();
        $fournisseur = new Fournisseur;
        $fournisseur = $em->getRepository('CatalogueBundle:Fournisseur')->findOneByToken($token);


        $form_ajout = $this->createForm(new FournisseurType(), $fournisseur);
        if ($request->isMethod('post')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {
                $em->persist($fournisseur);
                $em->flush();
                return $this->redirectToRoute('index4');
            }
        }

        return $this->render('CatalogueBundle:Fournisseur:edit.html.twig', array('form' => $form_ajout->createView()
                        // ...
        ));
    }

    public function deleteAction(Fournisseur $fournisseur) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($fournisseur);
        $em->flush();
        return $this->redirect($this->generateUrl('index4'));
    }

    

    public function rechercheAction(Request $request) {
        $fournisseur = new Fournisseur;
        $form_ajout = $this->createForm(new RechercheType());
        if ($request->isMethod('post')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {


                $em = $this->getDoctrine()->getManager();
                $data = $form_ajout->getData();
                $nom = $data['motcle'];
                $categorie = $data['categorie'];


                $fournisseur = $em->getRepository('CatalogueBundle:Fournisseur')->findByWord($nom,$categorie);
                
                var_dump($fournisseur);

                exit;


                return $this->redirectToRoute('recherche1');
            }
        }

        return $this->render('CatalogueBundle:Fournisseur:recherche.html.twig', array('form' => $form_ajout->createView()
                        // ...
        ));
    }

}
