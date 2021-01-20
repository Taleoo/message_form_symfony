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

      $Email = $this->getDoctrine()->getRepository(TEmail::class)->everything();
      $msg = [];
      for ($i = 0; $i < count($Email); $i++) {
        if ($Email[$i]->getTMsgs()->get('0') !== NULL)
        {
          array_push($msg, ['Email' => $Email[$i]->getEmail(), 'Subject' => $Email[$i]->getTMsgs()->get('0')->getSubject(), 'msg' => $Email[$i]->getTMsgs()->get('0')->getmsg()]);
        }
      }
    
      return $this->render('email/show.html.twig', ['msg' => $msg]);
    }
}
