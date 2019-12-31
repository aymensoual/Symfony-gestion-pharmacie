<?php

namespace CatalogueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CatalogueBundle\Entity\Client;
use CatalogueBundle\Form\ClientType;
use CatalogueBundle\Form\RechercheType;

class ClientController extends Controller {

    public function indexAction() {
        $client = new Client();
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('CatalogueBundle:Client')->findAll();

        return $this->render('CatalogueBundle:Client:index.html.twig', array('client' => $client
                        // ...
        ));
    }

    public function newAction(Request $request) {

        $client = new Client;
        $form_ajout = $this->createForm(new ClientType(), $client);
        if ($request->isMethod('post')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($client);
                $em->flush();
                return $this->redirectToRoute('index3');    
            }
        }

        return $this->render('CatalogueBundle:Client:new.html.twig', array('form' => $form_ajout->createView()
                        // ...
        ));
    }

    public function editAction(Request $request, $token) {

        $em = $this->getDoctrine()->getManager();
        $client = new Client;
        $client = $em->getRepository('CatalogueBundle:Client')->findOneByToken($token);


        $form_ajout = $this->createForm(new ClientType(), $client);
        if ($request->isMethod('post')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {
                $em->persist($client);
                $em->flush();
                return $this->redirectToRoute('index3');
            }
        }

        return $this->render('CatalogueBundle:Client:edit.html.twig', array('form' => $form_ajout->createView()
                        // ...
        ));
    }

    public function deleteAction(Client $client) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($client);
        $em->flush();
        return $this->redirect($this->generateUrl('index3'));
    }
    
    
    

    public function rechercheAction(Request $request) {
        $client = new Client;
        $form_ajout = $this->createForm(new RechercheType());
        if ($request->isMethod('post')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {


                $em = $this->getDoctrine()->getManager();
                $data = $form_ajout->getData();
                $nom = $data['motcle'];
                $medicament = $data['medicament'];


                $client = $em->getRepository('CatalogueBundle:Client')->findByWord($nom, $medicament);

                var_dump($client);

                exit;


                return $this->redirectToRoute('recherche1');
            }
        }

        return $this->render('CatalogueBundle:Client:recherche.html.twig', array('form' => $form_ajout->createView()
                        // ...
        ));
    }

}
