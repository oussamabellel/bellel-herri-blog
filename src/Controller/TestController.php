<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;


class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function index(PaginatorInterface $paginator,Request $request)
    {
        // $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        $posts = $paginator->paginate(
        $this->getDoctrine()->getRepository(Post::class)->findBy([], ['created_at' => 'DESC']),
        $request->query->getInt('page', 1),
        6 );
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'posts' => $posts
        ]);
    }
}
