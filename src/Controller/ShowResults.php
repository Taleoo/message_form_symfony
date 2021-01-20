<?php

namespace App\Controller;

use App\Repository\TEmailRepository;
use App\Entity\TEmail;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class ShowResults extends AbstractController
{
    /**
     * @Route("/results", name="show_results")
     */
    public function show_data(): Response
    { 
      // $toto = new ManagerRegistry();  
      // $repo = new TEmailRepository($toto);
      // $Email = $repo->everything();
      $Email = $this->getDoctrine()->getRepository(TEmail::class)->everything();
    
      return $this->render('email/show.html.twig', ['Email' => $Email]);
    }
}
