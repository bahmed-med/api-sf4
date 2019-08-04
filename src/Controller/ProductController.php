<?php

namespace App\Controller;

use App\Entity\Product;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use App\SearchRepository\ProductRepository;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;

/**
 * Class ProductController
 * @Rest\Route("/products")
 */
class ProductController extends AbstractFOSRestController
{
    /**
     * List the results of a product.
     * @Rest\Get("/list")
     * @Rest\View(populateDefaultVars=false, serializerGroups={"productList"})
     * @SWG\Response(response=Response::HTTP_OK, description="Ok")
     * @SWG\Tag(name="Product")
     *
     *
     */
    public function getAction()
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $products = $em->getRepository(Product::class)->findAll();
            return $this->view($products, Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->view($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     *
     * Search product.
     *
     * @Rest\Get("/saerch")
     * @Rest\View(populateDefaultVars=false, serializerGroups={"productList"})
     * @SWG\Response(response=Response::HTTP_OK, description="Ok")
     * @SWG\Tag(name="Product")
     *
     * @param RepositoryManagerInterface $manager
     * @return View
     */

    public function searchProductAction(RepositoryManagerInterface $manager)
    {
        /** @var ProductRepository $repository */
        $repository = $manager->getRepository(Product::class);
        //$repository = $em->getRepository(ProductRepository::class);

        $products = $repository->search('test', 10);

        return $this->view($products, Response::HTTP_OK);

    }

}
