<?php declare(strict_types=1);

namespace App\Controller\Blog;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/post/comment/{slug}', name: 'post_comment', methods: ["POST"] )]
    public function action(string $slug): Response
    {
        return $this->render('index.html.twig', []);
    }
}