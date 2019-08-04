<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class BlogController
 * @package App\Controller
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    private const POSTS = [
        [
            'id' => 1,
            'slug' => 'hello-world',
            'title' => 'Hello World'
        ],[
            'id' => 2,
            'slug' => 'another-post',
            'title' => 'Another post'
        ],[
            'id' => 3,
            'slug' => 'last-example',
            'title' => 'Last example'
        ],
    ];


    /**
     * @Route("/{page}", name="blog_index", requirements={"id"="\d+"}, methods={"GET"})
     * @param int $page
     * @return JsonResponse
     */
    public function indexAction(int $page = 1): JsonResponse
    {
        $repository = $this->getDoctrine()->getRepository(BlogPost::class);
        $items = $repository->findAll();


        return $this->json([
            'page' => $page,
            'data' => array_map(function ($item) {
                $this->generateUrl('blog_by_slug', ['slug' => $item->getSlug()]);
                return $item;
            }, $items)
        ]);
    }

    /**
     * @Route("/post/{id}", name="blog_by_id", requirements={"id"="\d+"}, methods={"GET"})
     * @param BlogPost $post
     * @return JsonResponse
     */
    public function postAction(BlogPost $post): JsonResponse
    {
        return $this->json($post);
    }

    /**
     * @Route("/post/{slug}", name="blog_by_slug", methods={"GET"})
     * @param BlogPost $post
     * @return JsonResponse
     */
    public function postBySlagAction(BlogPost $post): JsonResponse
    {
        return $this->json($post);
    }

    /**
     * @param Request $request
     * @param SerializerInterface $serializer
     * @Route("/post", name="blog_add", methods={"POST"})
     * @return JsonResponse
     */
    public function addAction(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $blogPost = $serializer->deserialize($request->getContent(), BlogPost::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($blogPost);
        $em->flush();

        return $this->json($blogPost);
    }

    /**
     * @param BlogPost $post
     * @Route("/post/{id}", name="blog_delete", requirements={"id"="\d+"}, methods={"DELETE"})
     * @return JsonResponse
     */
    public function deleteAction(BlogPost $post): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);

    }
}
