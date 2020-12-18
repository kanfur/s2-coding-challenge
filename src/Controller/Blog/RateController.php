<?php declare(strict_types=1);

namespace App\Controller\Blog;

use App\Entity\Post;
use App\Repository\RateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateController extends AbstractController
{
    #[Route('/post/rate/{id}', name: 'post_rate', methods: ["GET"] )]
    public function action(RateRepository $repository, Post $post, Request $request): Response
    {
        $repository->create($post->getRate(), $request->query->getInt('vote', 1));

        return $this->redirectToRoute('post_detail', ["slug" => $post->slug()]);
    }
}