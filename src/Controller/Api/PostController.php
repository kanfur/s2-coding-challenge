<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/', name: 'api_')]
final class PostController extends AbstractController
{
    #[Route('posts.json', name: 'posts', methods: ["GET"])]
    public function postsAction(
        PostRepository $repository
    ): Response {
        // TODO
    }
}
