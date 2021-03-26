<?php

namespace App\Controller;

use App\Entity\Rhum;
use App\Form\RhumType;
use App\Repository\RhumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rhum')]
class RhumController extends AbstractController
{
    #[Route('/', name: 'rhum_index', methods: ['GET'])]
    public function index(RhumRepository $rhumRepository): Response
    {
        return $this->render('rhum/index.html.twig', [
            'rhums' => $rhumRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'rhum_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $rhum = new Rhum();
        $form = $this->createForm(RhumType::class, $rhum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rhum);
            $entityManager->flush();

            return $this->redirectToRoute('rhum_index');
        }

        return $this->render('rhum/new.html.twig', [
            'rhum' => $rhum,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'rhum_show', methods: ['GET'])]
    public function show(Rhum $rhum): Response
    {
        return $this->render('rhum/show.html.twig', [
            'rhum' => $rhum,
        ]);
    }

    #[Route('/{id}/edit', name: 'rhum_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rhum $rhum): Response
    {
        $form = $this->createForm(RhumType::class, $rhum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $rhum->setModifiedAt(new \DateTime());
            $entityManager->persist($rhum);
            $entityManager->flush();

            // $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('rhum_index');
        }

        return $this->render('rhum/edit.html.twig', [
            'rhum' => $rhum,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'rhum_delete', methods: ['POST'])]
    public function delete(Request $request, Rhum $rhum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rhum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rhum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rhum_index');
    }
}
