<?php

namespace App\Controller;

use App\Classe\SearchItem;
use App\Entity\Contenus;
use App\Form\SearchItemType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request): Response
    {

        $search = new SearchItem();
        $form =$this->createForm(SearchItemType::class, $search);

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $search = $form->getData();
            $catalogue = $this->entityManager->getRepository(Contenus::class)->rechercher($search);
        } else {
            $catalogue = $this->entityManager->getRepository(Contenus::class)->findAll();
        }

        return $this->render('catalogue/index.html.twig', [
            'catalogue' => $catalogue,
            'form' => $form->createView()
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
