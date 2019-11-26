<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private $repository;

    public function __construct(PostRepository $repository) {

        $this->repository = $repository;
    }
    /**
     * @Route("/post/{id}", name="post")
     */
    public function index($id)
    {
        $post = $this->repository->find($id);
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'post' => $post
        ]);
    }

}
