<?php

namespace App\Controller;


use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/admin/categorie', name: 'admin_categorie')]
    public function index(CategorieRepository $rep): Response
    {
        $categorie=$rep->findAll();
        return $this->render('categorie/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }
    #[Route('/admin/categorie/create', name: 'admin_categorie_create')]
    public function creat(EntityManagerInterface $em,Request $request): Response
    {
        $categorie=new Categorie();
        //creation d'un objet formulaire
        $form=$this->createForm(CategorieType::class,$categorie);
        //Récupération et traitement des données
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('admin_categorie');

        }
        //affichage du formulaire
        return $this->render('categorie/create.html.twig', [
            'f' => $form,
        ]);

    }
    #[Route('/admin/categorie/update/{id}', name: 'admin_categorie_update')]
    public function update(Categorie $categorie,EntityManagerInterface $em,Request $request): Response
    {
        
        //creation d'un objet formulaire
        $form=$this->createForm(CategorieType::class,$categorie);
        //Récupération et traitement des données
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('admin_categorie');

        }
        //affichage du formulaire
        return $this->render('categorie/update.html.twig', [
            'f' => $form,
        ]);

    }
}
