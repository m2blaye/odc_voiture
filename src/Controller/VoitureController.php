<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VoitureController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('index.html.twig');
    }
    /**
     * @Route("/voiture", name="voiture_index")
     */
    public function index(VoitureRepository $voitureRepository)
    {
        $voitures = $voitureRepository->findAll();
       // dd($voitures);
        return $this->render('voiture/index.html.twig', compact('voitures'));
    }

     /**
     * @Route("/voiture/create", name="voiture_create")
     */
    public function create(Request $request):Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($voiture);
           
            $em->flush();
            dd($voiture);
            return $this->redirectToRoute('voiture_index');
        }
        return $this->render('voiture/create.html.twig', [
             'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/voiture/{id<[0-9]+>}", name="voiture_read")
    */
    public function read(Voiture $voiture)
    {
        
        $pers=$voiture->getPersonne();
        $id_pers=$pers->getId();
        //$personne=
        return $this->render('voiture/read.html.twig', compact('voiture'));
    }
     /**
     * @Route("/voiture/{id<[0-9]+>}/edite", name="voiture_edite", methods={"GET","POST"})
     */
    public function edite(Request $request,Voiture $voiture):Response
    {
        $form = $this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
           // $em->persist($voiture);
            $em->flush();
            $this->addFlash('success', 'We saved a battle with id ' );
            return $this->redirectToRoute('voiture_index');
        }
        return $this->render('voiture/create.html.twig', [
            'voiture' => $voiture,
             'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/voiture/{id<[0-9]+>}/delete", name="voiture_delete")
    */
    public function delete(EntityManagerInterface $em, Voiture $voiture)
    {
        //dd($voiture);
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute('voiture_index');
    }
}
