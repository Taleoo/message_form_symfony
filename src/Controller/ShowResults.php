<?php

namespace App\Controller;

use App\Repository\TEmailRepository;
use App\Entity\TEmail;
use App\Entity\TMsg;
use App\Form\Type\StateForm;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;





class ShowResults extends AbstractController
{
    /**
     * @Route("/results", name="show_results")
     */

      /*  
      Function called to render and handle the first form 
      */

    public function show_data(Request $request): Response
    { 

      /*
        Second page with the results handling also the update State form
      */

      //use the everything() method from FormTemail to get a custom build query that returns everything from every table

      $Email = $this->getDoctrine()->getRepository(TEmail::class)->everything();
      $msg = [];

      //Parse the data to populate $msg with the data we want to show

      foreach ($Email as $data) {
        if ($data->getTMsgs()->get('0') !== NULL && $data->getTPeople()->get('0'))
        {
          array_push($msg, [
            'Email' => $data->getEmail(),
            'Subject' => $data->getTMsgs()->get('0')->getSubject(),
            'id_msg' => $data->getTMsgs()->get('0')->getId(),
            'msg' => $data->getTMsgs()->get('0')->getmsg(),
            'state' => $data->getTMsgs()->get('0')->getState(),
            'date' => $data->getTMsgs()->get('0')->getDate(),
            'Nom' => $data->getTPeople()->get('0')->getLastName(),
            'Prénom' => $data->getTPeople()->get('0')->getFirstName(),
            'Téléphone' => $data->getTPeople()->get('0')->getPhone(),
            ]);
        }
      }
      $forms = [];
      /*
        Create as many forms as there are TMsgs in the everything() result meth Populate the $forms array with a view for each form
        Had to assign a index to give the forms different names
      */
      for ($i = 0; $i<count($Email); $i++)
      {
        $formData = $Email[$i]->getTMsgs()->get('0');   
        $forms[$i] = $this->container
        ->get('form.factory')
        ->createNamed('form' . $i, StateForm::class, $formData);
        $forms[$i]->handleRequest($request);
        if ($forms[$i]->isSubmitted() && $forms[$i]->isValid()) {
            $task= $forms[$i]->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
            return $this->redirectToRoute('show_results');

      }      
      $forms[$i] = $forms[$i]->createView();
      }                  
        
      //Render everything by passing the results to show and the forms to render to an array

      return $this->render('email/show.html.twig', array(                                         
        'forms' => $forms,
        'msg' => $msg                                                                      
      ));
    }
}
