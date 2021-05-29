<?php

namespace App\Controller;

use App\Entity\Pan;
use App\Repository\PanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PansController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(PanRepository $panRepository): Response
    {
        $pans = $panRepository->findAll();
        // la fonction compact() permet de "compacter" notre code
        //C'est plus rapide que de passer les variable comme ceci : ['pans' => $pans]
        return $this->render('pans/index.html.twig', compact('pans'));
    }
    
    /**
     * @Route("/show/{id<[0-9+]>}", name="app_pans_show")
     */
    public function show(Pan $pan): Response
    {
        return $this->render('pans/show.html.twig', compact('pan'));
    }
    
}
