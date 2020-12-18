<?php declare(strict_types=1);

namespace App\Controller\Blog;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DetailController extends AbstractController
{
    #[Route('/detail/{slug}', name: 'post_detail')]
    public function action(PostRepository $repository, string $slug): Response
    {
        $post = $repository->detail($slug) ?: throw new NotFoundHttpException();

        return $this->render('post/detail.html.twig', ['post' => $post]);
    }
}