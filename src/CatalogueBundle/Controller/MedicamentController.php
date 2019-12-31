<?php

namespace CatalogueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CatalogueBundle\Entity\Medicament;
use CatalogueBundle\Form\MedicamentType;
use CatalogueBundle\Form\RechercheType;

class MedicamentController extends Controller {

    public function indexAction() {
        $medicament = new Medicament();
        $em = $this->getDoctrine()->getManager();
        $medicament = $em->getRepository('CatalogueBundle:Medicament')->findAll();

        return $this->render('CatalogueBundle:Medicament:index.html.twig', array('medicament' => $medicament
                        // ...
        ));
    }

    public function newAction(Request $request) {

        $medicament = new Medicament;
        $form_ajout = $this->createForm(new MedicamentType(), $medicament);
        if ($request->isMethod('post')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($medicament);
                $em->flush();
                return $this->redirectToRoute('index1');
            }
        }

        return $this->render('CatalogueBundle:Medicament:new.html.twig', array('form' => $form_ajout->createView()
                        // ...
        ));
    }

    public function editAction(Request $request, $token) {

        $em = $this->getDoctrine()->getManager();
        $medicament = new Medicament;
        $medicament = $em->getRepository('CatalogueBundle:Medicament')->findOneByToken($token);


        $form_ajout = $this->createForm(new MedicamentType(), $medicament);
        if ($request->isMethod('post')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {
                $em->persist($medicament);
                $em->flush();
                return $this->redirectToRoute('index1');
            }
        }

        return $this->render('CatalogueBundle:Medicament:edit.html.twig', array('form' => $form_ajout->createView()
                        // ...
        ));
    }

    public function deleteAction(Medicament $medicament) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($medicament);
        $em->flush();
        return $this->redirect($this->generateUrl('index1'));
    }

    

    public function rechercheAction(Request $request) {
        $medicament = new Medicament;
        $form_ajout = $this->createForm(new RechercheType());
        if ($request->isMethod('post')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {


                $em = $this->getDoctrine()->getManager();
                $data = $form_ajout->getData();
                $nom = $data['motcle'];
                $medicament = $data['medicament'];


                $medicament = $em->getRepository('CatalogueBundle:Medicament')->findByWord($nom,$medicament);
                
                var_dump($medicament);

                exit;


                return $this->redirectToRoute('recherche1');
            }
        }

        return $this->render('CatalogueBundle:Medicament:recherche.html.twig', array('form' => $form_ajout->createView()
                        // ...
        ));
    }

}
