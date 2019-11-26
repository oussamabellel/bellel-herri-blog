<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post/{id}", name="post")
     */
    public function index($id)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'post' => $post
        ]);
    }
}
