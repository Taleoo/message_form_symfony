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
      foreach ($Email as $data) {
        if ($data->getTMsgs()->get('0') !== NULL && $data->getTPeople()->get('0'))
        {
          array_push($msg, [
            'Email' => $data->getEmail(),
            'Subject' => $data->getTMsgs()->get('0')->getSubject(),
            'msg' => $data->getTMsgs()->get('0')->getmsg(),
            'Nom' => $data->getTPeople()->get('0')->getLastName(),
            'Prénom' => $data->getTPeople()->get('0')->getFirstName(),
            'Téléphone' => $data->getTPeople()->get('0')->getPhone(),
            ]);
        }
      }
    
      return $this->render('email/show.html.twig', ['msg' => $msg]);
    }
}
