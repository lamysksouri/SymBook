<?php

namespace App\Controller;

use App\Repository\LivresRepository;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DashbordController extends AbstractController
{
    #[Route('/dashbord', name: 'app_dashbord')]
    public function index(CommandeRepository $comande,LivresRepository $livre,Request $request): Response
    {
        $startDate = new \DateTime();
        $endDate = new \DateTime();
    
        $form = $this->createFormBuilder()
            ->add('start_date', DateType::class, ['data' => $startDate])
            ->add('end_date', DateType::class, ['data' => $endDate])
            ->add('submit', SubmitType::class, ['label' => 'Submit'])
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $startDate = $data['start_date'];
            $endDate = $data['end_date'];
        }
    
        // Récupérer les commandes dans la période sélectionnée
        $orders = $comande->findByDateRange($startDate, $endDate);
    
        return $this->render('dashbord/index.html.twig', [
            'form' => $form->createView(),
            'orders' => $orders,
        ]);

        /* Récupérer les livres dans la période sélectionnée
        $livres = $livre->findAll();

        return $this->render('dashbord/index.html.twig', [
        'form' => $form->createView(),
        'orders' => $orders,
        'livres' => $livres, // Correct variable name
        ]);*/
    }
}
