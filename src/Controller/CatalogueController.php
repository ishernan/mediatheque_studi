<?php

namespace App\Controller;

use App\Entity\Contenus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/catalogue', name: 'catalogue')]
    public function index(): Response
    {
        $catalogue = $this->entityManager->getRepository(Contenus::class)->findAll();

        return $this->render('catalogue/index.html.twig', [
            'catalogue' => $catalogue
        ]);
    }

    #[Route('/item/{slug}', name: 'item')]

    public function items($slug): Response
    {

        $item = $this->entityManager->getRepository(Contenus::class)->findOneBy(['slug'=> $slug]);

        if(!$item) {
            return $this->redirectToRoute('catalogue');
        }

        return $this->render('catalogue/item.html.twig', [
            'item' => $item
        ]);
    }
}
