<?php

namespace App\Controller;

use App\Classe\DocsReservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function index(DocsReservation $reservation): Response
    {
        dd($reservation->get());

        return $this->render('reservation/index.html.twig');
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
}
