<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\User;
use App\Form\Api\PostType;
use MediaMonks\RestApi\Exception\FormValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\AbstractType;

/**
 * @Route("/api/blogs")
 */
class BlogController extends Controller
{
    /**
     * @Route("", name="api_blog_index", methods="GET")
     */
    public function index()
    {
        return $this->getDoctrine()->getRepository(Post::class)->findAll();
    }

    /**
     * @Route("/new", name="api_blog_new", methods="POST")
     * @param Request $request
     */
    public function new(Request $request)
    {
        $post = [];

        if (!empty($request->request->all())) {
            try {
                $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => 'test']);
                $post = new Post();
                $form = $this->createForm(PostType::class, $post);
                $form->submit([
                    'title' => $request->request->get('title'),
                    'body' => $request->request->get('body'),
                    'tags' => json_decode($request->request->get('tags'), true)
                ]);
                if (!$form->isValid()) {
                    throw new FormValidationException($form);
                }

                $em = $this->getDoctrine()->getManager();
                $post->setUser($user);
                $em->persist($post);
                $em->flush();
            } catch (\Exception $e) {
                //$this->logger->err($e-getMessage());
                throw new \Exception('An exception has been caught, please check log file.');
            }
        }

        return $post;
    }

    /**
     * @Route("/{id}", name="api_blog_show", methods="GET")
     * @param integer $id
     */
    public function show($id)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        return !empty($post) ? $post : [];
    }

    /**
     * @Route("/edit/{id}", name="api_blog_edit", methods="PUT")
     * @param integer $id
     * @param Request $request
     */
    public function edit($id, Request $request)
    {
        $post = [];

        if (!empty($request->request->all())) {
            try {
                $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => 'test']);
                $post = new Post();
                $form = $this->createForm(PostType::class, $post);
                $form->submit([
                    'title' => $request->request->get('title'),
                    'body' => $request->request->get('body'),
                    'tags' => json_decode($request->request->get('tags'), true)
                ]);
                if (!$form->isValid()) {
                    throw new FormValidationException($form);
                }
                $this->getDoctrine()->getManager()->flush();
            } catch (\Exception $e) {
                throw new \Exception('An exception has been caught, please check log file.');
            }
        }

        return $post;
    }

    /**
     * @Route("/delete/{id}", name="api_blog_delete", methods="DELETE")
     * @param integer $id
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

        $entityManager->remove($post);
        $entityManager->flush();

        return null === $post;
    }
}
