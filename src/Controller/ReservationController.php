<?php

namespace App\Controller;

use App\Classe\DocsReservation;
use App\Entity\Contenus;
use App\Entity\Reservations;
use App\Repository\ContenusRepository;
use App\Repository\IntervalRepository;
use App\Repository\ReservationsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\Date;

class ReservationController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager,
        private ContenusRepository $contenusRepository,
        private IntervalRepository $intervalRepository,
    private ReservationsRepository $reservationsRepository
    )
    {
        $this->em = $entityManager;
    }

    #[Route('/reservation', name: 'reservation')]
    public function index(DocsReservation $reservation, UserInterface $user): Response
    {

        $reservations = $this->reservationsRepository->findByUserId($user->getId());

       return $this->render('reservation/index.html.twig', [
           'reservation' => $reservations
       ]);
    }


    #[Route('/reservation/add/{id}', name: 'add_reservation')]
    public function add(Contenus $id, UserInterface $user, UserRepository $userRepository): Response
    {
        $contenu = $this->contenusRepository->find($id);
        $reservation = new Reservations();
        # recuperation de l'interval pour reservations
        $interval= $this->intervalRepository->findOneBy(['type_interval' => 'reservation']);
        # les dates
        $now = new \DateTime('NOW');
        $expiration = (new \DateTime('NOW'))->add(new \DateInterval($interval->getIntervalValue()));

        $reservation
            ->setIdUser($user->getId())
            ->setIdContenu($contenu->getId())
            ->setReservationDate($now)
            ->setExpirationDate($expiration);
        $this->em->persist($reservation);
        $this->em->flush();

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
