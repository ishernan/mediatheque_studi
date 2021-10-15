<?php

namespace App\Controller;

use App\Classe\DocsReservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BorrowController extends AbstractController
{
    #[Route('/emprunts', name: 'borrow')]
    public function index(DocsReservation $recap): Response
    {
        return $this->render('borrow/index.html.twig', [
            'recap' => $recap->getFull()
        ]);
    }


}
