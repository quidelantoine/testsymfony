<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage', methods: ['GET'])]
    public function index(Request $request, LoggerInterface $logger): Response
    {
        $logger->info('je suis sur la page accueil');
        return $this->render('default/index.html.twig');
    }


    #[Route('/blog/{page}', name: 'blog', requirements: ['page' => '\d+'])]
    public function blog(int $page = 1): Response
    {

        return $this->render('default/blog.html.twig');
    }
}
