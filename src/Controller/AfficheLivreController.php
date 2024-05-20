<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AfficheLivreController extends AbstractController
{
    #[Route('/affiche/livre', name: 'app_affiche_livre')]
    public function index(): Response
    {
        return $this->render('affiche_livre/index.html.twig', [
            'controller_name' => 'AfficheLivreController',
        ]);
    }
}
