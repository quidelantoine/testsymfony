<?php

namespace App\Controller;

use App\Entity\Legume;
use App\Form\LegumeType;
use App\Repository\LegumeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegumeController extends AbstractController
{
    #[Route('/legumes', name: 'legumes')]
    public function index(LegumeRepository $repo): Response
    {
        //$repo = new LegumeRepository();
        $legumes = $repo->findAll();
        //dd($legumes);
        return $this->render('legume/index.html.twig', array(
            'legumes' => $legumes
        ));
    }

    #[Route('/legume/{id}', name: 'legume', requirements: ['page' => '\d+'])]
    public function show(Legume $legume): Response
    {
//        $legume = $repo->find($id);
//        if(empty($legume)) {
//            throw $this->createNotFoundException('légume not found');
//        }
        return $this->render('legume/show.html.twig', array(
            'legume' => $legume
        ));
    }
    #[Route('/new/legume', name: 'new_legume', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $legume = new Legume();
        $form = $this->createForm(LegumeType::class,$legume);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$legume->setCreatedAt(new \DateTime());
            $entityManager->persist($legume);
            $entityManager->flush();

            $this->addFlash('success','Merci pour votre légume.');
            return $this->redirectToRoute('legumes');
        }
        return $this->render('legume/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    #[Route('/edit/legume/{id}', name: 'edit_legume', requirements: ['page' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request,Legume $legume)
    {
        $form = $this->createForm(LegumeType::class,$legume);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($legume);
            $entityManager->flush();
            $this->addFlash('success','Merci pour avoir edité ce légume.');
            return $this->redirectToRoute('legumes');
        }
        return $this->render('legume/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    #[Route('/delete/legume/{id}', name: 'delete_legume', requirements: ['page' => '\d+'], methods: ['DELETE'])]
    public function delete(Request $request,Legume $legume) : Response
    {
        if($this->isCsrfTokenValid('delete' . $legume->getId(), $request->request->get('_token'))) {
            $this->addFlash('success','Merci pour avoir effacé ce légume.');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($legume);
            $entityManager->flush();
        }
        return $this->redirectToRoute('legumes');
    }

}
