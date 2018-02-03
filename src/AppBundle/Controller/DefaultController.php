<?php

namespace AppBundle\Controller;

use AppBundle\Pagination\PaginationFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="products")
     */
    public function productsAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $dql = $em->getRepository('AppBundle:Product')->dqlAll();
        $pager = $this->get(PaginationFactory::class)->create($dql, $request);

        return $this->render('AppBundle:Product:list.html.twig', [
            'pagination' => $pager
        ]);
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categoriesAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $dql = $em->getRepository('AppBundle:Category')->dqlAll();
        $pager = $this->get(PaginationFactory::class)->create($dql, $request);

        return $this->render('AppBundle:Category:list.html.twig', [
            'pagination' => $pager
        ]);
    }

    /**
     * @Route("/{category_name}", name="category_products")
     *
     * @ParamConverter("category", class="AppBundle:Category", options={"mapping": {"category_name": "slug"}})
     */
    public function categoryProductAction(Request $request, $category)
    {
        $em = $this->get('doctrine')->getManager();
        $dql = $em->getRepository('AppBundle:Product')->dqlByCategory($category);
        $productsPager = $this->get(PaginationFactory::class)->create($dql, $request);

        $categories = $em->getRepository('AppBundle:Category')->findAll();

        return $this->render('AppBundle:Category:show.html.twig', [
            'object' => $category,
            'categories' => $categories,
            'productsPager' => $productsPager
        ]);
    }
}
