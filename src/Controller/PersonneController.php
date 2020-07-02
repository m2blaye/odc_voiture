<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="personne_index")
     */
    public function index(PersonneRepository $personneRepository)
    {
        $personnes = $personneRepository->findAll();
        return $this->render('personne/index.html.twig', compact('personnes'));
    }
            /* public function view(PersonneRepository $personneRepository,$id)
                {
                    
                    //dd($personne);
                    $personne = $personneRepository->find($id);
                    dd($personne);
                ;
                }
            */
    /**
     * @Route("/personne/{id<[0-9]+>}", name="personne_read")
    */
    public function read(Personne $personne)
    {
        return $this->render('personne/read.html.twig', compact('personne'));
    }
     /**
     * @Route("/personne/create", name="personne_create")
     */
    public function create(Request $request):Response
    {
        $personne = new Personne();
        $form = $this->createForm(PersonneType::class,$personne);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();
        }
        return $this->render('personne/create.html.twig', [
             'form'=> $form->createView()
        ]);
    }
}
