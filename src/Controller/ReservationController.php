<?php

namespace App\Controller;

use App\Classe\DocsReservation;
use App\Entity\Contenus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/reservation', name: 'reservation')]
    public function index(DocsReservation $reservation): Response
    {
       $emprunts  = [];

       if ($reservation->get()){
       foreach ($reservation->get() as $id => $quantity){
        $emprunts[]= [
            'items' => $this->entityManager->getRepository(Contenus::class)->findOneBy(['id'=>$id]),
            'quantity'=> $quantity
        ];

       }

    }
       return $this->render('reservation/index.html.twig', [
           'reservation' => $emprunts
       ]);
    }


    #[Route('/reservation/add/{id}', name: 'add_reservation')]
    public function add(DocsReservation $reservation, $id): Response
    {
        $reservation->add($id);

        return $this->redirectToRoute('reservation');
    }


    #[Route('/reservation/remove', name: 'remove_reservation')]

    public function remove(DocsReservation $reservation): Response
    {
        $reservation->remove();


        return $this->redirectToRoute('catalogue');
    }



    #[Route('/reservation/removeItem/{id}', name: 'remove_item')]

    public function remove_item(DocsReservation $reservation,$id): Response
    {
        $reservation->remove_item($id);

        return $this->redirectToRoute('reservation');
    }
}
