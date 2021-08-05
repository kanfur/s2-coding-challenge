<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Entity\Post;
use App\Form\RateType;
use App\Repository\RateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RateController extends AbstractController
{
    #[Route('/post/rate/{id}', name: 'post_rate', methods: ["POST"] )]
    public function action(RateRepository $repository, Post $post, Request $request): Response
    {
        $form = $this->createForm(RateType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->create($post->getRate(), (int)$form->get('value')->getData());
        }

        return $this->redirectToRoute('post_detail', ["slug" => $post->slug()]);
    }
}
