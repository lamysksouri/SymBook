<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Order;
use App\Form\OrderType;
use App\Entity\OrderItem;
use App\Repository\LivresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanigerController extends AbstractController
{
    #[Route('/panigner', name: 'app_paniger')]
    public function index(SessionInterface $session,LivresRepository $LivresRepository): Response
    {
        $panier=$session->get('panier',[]);


        $panierWithData=[];
        foreach($panier as $id=>$qte){
            $panierWithData[]=[
                'livre'=>$LivresRepository->find($id),
                 'quantite'=>$qte         ];
        }
        $total=0;
        foreach($panierWithData as $item){
            $totalItem=$item['livre']->getPrix()*$item['quantite'];
            $total+=$totalItem;
        }
        return $this->render('paniger/index.html.twig', [
            'items'=>$panierWithData,
            'total'=>$total
        ]);
    }
    #[Route("/panigner/add/{id}",name:'app_paniger_add')]
    public function add($id,SessionInterface $session){
 
        $panier=$session->get('panier',[]);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }
        else{
            $panier[$id]=1;
        }
       
        $session->set('panier',$panier);
        return $this->redirectToRoute("app_paniger");
    }
    #[Route("/panigner/remove/{id}",name:'app_paniger_remove')]
    public function remove($id,SessionInterface $session){
        $panier=$session->get('panier',[]);
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $session->set('panier',$panier);
        return $this->redirectToRoute("app_paniger");
    }
    #[Route('/panigner/increment/{id}', name: 'app_paniger_increment')]
public function increment($id, SessionInterface $session): Response
{
    $panier = $session->get('panier', []);
    if (!empty($panier[$id])) {
        $panier[$id]++;
    }
    $session->set('panier', $panier);
    return $this->redirectToRoute('app_paniger');
}

#[Route('/panigner/decrement/{id}', name: 'app_paniger_decrement')]
public function decrement($id, SessionInterface $session): Response
{
    $panier = $session->get('panier', []);
    if (!empty($panier[$id])) {
        if ($panier[$id] > 1) {
            $panier[$id]--;
        } else {
            unset($panier[$id]);
        }
    }
    $session->set('panier', $panier);
    return $this->redirectToRoute('app_paniger');
}

#[Route('/panigner/checkout', name: 'app_panigner_checkout')]
    public function checkout(Request $request, SessionInterface $session, LivresRepository $livresRepository, EntityManagerInterface $entityManager, Security $security,User $user): Response
    {
        
    $panier = $session->get('panier', []);

    if (empty($panier)) {
        return $this->redirectToRoute('app_panigner');
    }

    // Récupérez l'utilisateur connecté
    $user = $security->getUser();

    // Vérifiez si l'utilisateur est connecté
    if (!$user instanceof User) {
        // Gérez le cas où aucun utilisateur n'est connecté
        // Par exemple, redirigez l'utilisateur vers la page de connexion
        return $this->redirectToRoute('login');
    }

    // Créez une nouvelle commande
    
    // Assignez l'utilisateur connecté à la commande
 

    // Pour chaque élément dans le panier, créez un objet OrderItem et associez-le à la commande
    foreach ($panier as $id => $qte) {
        $livre = $livresRepository->find($id);
        if ($livre) {
            $orderItem = new OrderItem();
            $orderItem->setOrder($user); // Associez l'OrderItem à la commande
            $orderItem->setBookTitle($livre->getTitre());
            $orderItem->setBookPrice($livre->getPrix());
            $orderItem->setQuantity($qte);
            $orderItem->setTotal($livre->getPrix() * $qte);
            // Enregistrez l'objet OrderItem dans la base de données
            $entityManager->persist($orderItem);
        }
    }

    // Exécutez la transaction enregistrant les commandes dans la base de données
    $entityManager->flush();

    // Effacez le panier de la session une fois la commande enregistrée
    $session->set('panier', []);

    // Redirigez l'utilisateur vers une page de confirmation ou une autre page appropriée
    return $this->redirectToRoute('app_paniger');}}