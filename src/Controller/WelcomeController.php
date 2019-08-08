<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/welcome", name="welcome")
     */
    public function index()
    {
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }


    /**
     * @Route(
     * 		"/symfony-controller-test/{name_one?}",
     * 		name="symfony_controller_test",
     * 		defaults = {"name_one" = "Default: Md Rafik Kamal"},
     * 		requirements = {"name_one" = "[A-Za-z]+"}
     * )
     */
    public function symfonyControllerTest(Request $request)
    {
    	$name = $request->query->get('name', 'Default: Rafik Kamal');
    	$name_one = $request->get('name_one');
        return $this->render('welcome/symfony_contoller_test.html.twig', [
            'controller_name' 	=> 'WelcomeController',
            'some_variable'		=> 'Md Rafik Kamal',
            'name'				=> ucwords($name),
            'name_test_link'	=> $this->generateUrl(
            	'symfony_controller_test', 
            	['name' => 'rafik'], 
            	UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'name_one'				=> ucwords($name_one),
            'name_one_test_link'	=> $this->generateUrl(
            	'symfony_controller_test', 
            	['name_one' => 'rafik'], 
            	UrlGeneratorInterface::ABSOLUTE_URL
            )
        ]);
    }
}
