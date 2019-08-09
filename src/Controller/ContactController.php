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
    public function contact(Request $request)
    {
    	$form = $this->createForm(ContactType::class);
    	$form->handleRequest($request);
    	
    	if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            dump($contactFormData);
            // Submit an email
            
        }

        return $this->render('contact/index.html.twig', [
            'our_form' => $form->createView(),
        ]);
    }
}
