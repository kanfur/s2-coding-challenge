<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PostsController extends AbstractController
{
    #[Route('/admin/posts', name: 'admin_posts')]
    public function index(): Response
    {
        return $this->render('admin/posts/index.html.twig', [
            'controller_name' => 'PostsController',
        ]);
    }
}
