<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\ContactType;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
    	$form = $this->createForm(ContactType::class);
    	$form->handleRequest($request);

    	//$this->addFlash('info', 'Some useful info');
    	
    	if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            dump($contactFormData);
            /**
             * Submit an email
             */
            $message = (new \Swift_Message('Hello Email'))
		        ->setFrom($contactFormData['from'])
		        ->setTo('rafik.rkn@gmail.com')
		        ->setBody(
		            $contactFormData['message'],
		            'text/plain'
		        );
		    /**
		     * Send email 
		     */
		    if($mailer->send($message)) {
		    	$this->addFlash('success', 'Email was sent!');
		    	return $this->redirectToRoute('contact');	
		    } else {
		    	$this->addFlash('alert', 'Failed to send email!');
		    }
        }

        return $this->render('contact/index.html.twig', [
            'our_form' => $form->createView(),
        ]);
    }
}
