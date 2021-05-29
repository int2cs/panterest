<?php

namespace App\Controller;

use App\Entity\Pan;
use App\Form\PanType;
use App\Repository\PanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PansController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function index(PanRepository $panRepository): Response
    {
        $pans = $panRepository->findBy([], ['createdAt' => 'DESC']);

        // la fonction compact() permet de "compacter" notre code
        //C'est plus rapide que de passer les variable comme ceci : ['pans' => $pans]
        return $this->render('pans/index.html.twig', compact('pans'));
    }
    
    /**
     * @Route("/pans/{id<[0-9+]>}", name="app_pans_show", methods={"GET"})
     */
    public function show(Pan $pan): Response
    {
        return $this->render('pans/show.html.twig', compact('pan'));
    }

    /**
     * @Route("/pans/add", name="app_pans_add", methods={"GET|POST"})
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PanType::class, new Pan);

            //On récupère les infos passé dans la requête
            //pour les traiter directement sur le formulaire
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $data = $form->getData();

                $em->persist($data);
                $em->flush();

                $this->addFlash('success', 'Ajout effectué avec succès');

                return $this->redirectToRoute('app_home');
            }

        return $this->render('pans/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/pans/edit/{id<[0-9+]>}", name="app_pans_edit", methods={"GET|PUT"})
     */
    public function update(Pan $pan, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PanType::class, $pan, [
            'method' => 'PUT'
        ]);

                    $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid()){
                        $em->flush();

                        $this->addFlash('success', 'Modification effectué avec succès');

                        return $this->redirectToRoute('app_home');
                    }

        return $this->render('pans/edit.html.twig', [
            'pan' => $pan,
            'form' => $form->createView()
        ]);
    }
     /**
     * @Route("/pans/{id<[0-9+]>}", name="app_pans_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pan $pan, EntityManagerInterface $em): Response
    {
        $token = $request->request->get('csrf_token');
        if($this->isCsrfTokenValid('pan_delete_' . $pan->getId(), $token))
        $em->remove($pan);
        $em->flush();

        $this->addFlash('info', 'Suppression effectué avec succès');

        return $this->redirectToRoute('app_home');
    }
}