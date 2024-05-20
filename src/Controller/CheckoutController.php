<?php
// src/Controller/CheckoutController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;

class CheckoutController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout")
     */
    public function index(Request $request)
    {
        // Retrieve the logged-in user's information
        $loggedInUser = $this->getUser();

        // Create a form instance and pass the logged-in user's information as default data
        $form = $this->createForm(UserType::class, $loggedInUser, [
            'data' => $loggedInUser, // Set the default data to the logged-in user's data
        ]);

        // Handle form submission
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Process the form submission
            // ...
        }

        return $this->render('checkout1/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
