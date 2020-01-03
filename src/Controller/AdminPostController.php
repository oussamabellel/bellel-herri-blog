<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class AdminPostController extends AbstractController
{

    private $repository;

    public function __construct(PostRepository $repository) {

        $this->repository = $repository;
    }

    /**
     * @Route("/admin/posts", name="admin_post")
     */
    public function index(PaginatorInterface $paginator,Request $request)
    {
        $posts = $paginator->paginate(
            $this->getDoctrine()->getRepository(Post::class)->findBy([], ['created_at' => 'DESC']),
            $request->query->getInt('page', 1),
            6 );
        //$posts = $this->repository->findAll();
        return $this->render('admin_post/index.html.twig', [
            'controller_name' => 'AdminPostController',
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/admin/posts/edit/{id}", name="admin_edit")
     */
    public function edit (Post $post,Request $request) 
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->flush();
           $this->addFlash('success', 'Post edited sucessfully');
           return $this->redirectToRoute('admin_post');
        }
        return $this->render('admin_post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/admin/posts/create", name="admin_create")
     */
    public function create (Request $request) 
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->persist($post);
           $em->flush();
           $this->addFlash('success', 'Post created sucessfully');
           return $this->redirectToRoute('admin_post');
        }
        return $this->render('admin_post/create.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/posts/delete/{id}", name="admin_delete", methods="DELETE")
     */
    public function delete (Post $post, Request $request) 
    {

        if ($this->isCsrfTokenValid('delete' . $post->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
         }   
        $this->addFlash('success', 'Post deleted sucessfully');
        return $this->redirectToRoute('admin_post');
    
    }

}
