<?php declare(strict_types=1);

namespace App\Controller\Blog;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RSSController extends AbstractController
{
    #[Route('/data.rss', name: 'rss')]
    public function action(PostRepository $repository): Response
    {
        return new Response($repository->rss(10)->render('rss'));
    }
}