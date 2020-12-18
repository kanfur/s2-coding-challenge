<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImprintController extends AbstractController
{
    #[Route('/imprint', name: 'imprint')]
    public function action(): Response
    {
        return $this->render('index.html.twig', []);
    }
}
