<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function index()
    {

        // $post = new Post();
        // $post->setTitle('post');
        // $post->setDescription('my new post');

        // $em = $this->getDoctrine()->getManager();
        // $em->persist($post);
        // $em->flush();


        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
        ]);
    }
}
