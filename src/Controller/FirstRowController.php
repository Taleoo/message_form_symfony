<?php

namespace App\Controller;

use App\Entity\TEmail;
use App\Entity\TMsg;
use App\Entity\TPerson;
use App\Form\Type\EmailForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class FirstRowController extends AbstractController
{
    /**
     * @Route("/", name="create_first")
     */

    /*  
      Function called to render and handle the first form 
    */
    public function create_row(Request $request): Response
    {   
      /*
        Creating a new object TEmail to populate it with results
        Used the methods to get to the relationships TMsg and TPerson
      */
      $task = new TEmail();
      $task->setEmail('');
      $task->addTPerson($person = new TPerson('', '', ''));
      $task->addTMsg($msg = new TMsg('', ''));

      // Form creation from the FormTEmail file

      $form = $this->createForm(EmailForm::class, $task);
      $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            //Setting default values for Date and State after getting the data

            $entityManager = $this->getDoctrine()->getManager();
            $task->getTMsgs()->get('0')->setDate(\DateTime::createFromFormat(
              'U',
              time() + 1
            ));
            $task->getTMsgs()->get('0')->setState('A traiter');

            //Persist to Database

            $entityManager->persist($task);
            $entityManager->persist($person);
            $entityManager->persist($msg);
            $entityManager->flush();

            //Redirect to the same route after Form is handled

            return $this->redirectToRoute('create_first');
        }

        //Render the view 

      return $this->render('email/new.html.twig', [
        'form' => $form->createView(),
    ]);
    }
}
