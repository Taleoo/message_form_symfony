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
    public function create_row(Request $request): Response
    {   
      $task = new TEmail();
      $task->setEmail('');
      $task->addTPerson($person = new TPerson('', '', ''));
      $task->addTMsg($msg = new TMsg('', ''));

      $form = $this->createForm(EmailForm::class, $task);
      $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->persist($person);
            $entityManager->persist($msg);
            $entityManager->flush();

            return $this->redirectToRoute('create_first');
        }
        
      return $this->render('email/new.html.twig', [
        'form' => $form->createView(),
    ]);
    }
}
