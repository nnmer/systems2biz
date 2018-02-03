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
     * @Route("/", name="categories")
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
     * @Route("/{slug}", name="category_products")
     *
     * @ParamConverter("category", class="AppBundle:Category", options={"mapping": {"slug": "slug"}})
     */
    public function categoryProductAction(Request $request, $category)
    {
        $em = $this->get('doctrine')->getManager();
        $dql = $em->getRepository('AppBundle:Product')->dqlByCategory($category);
        $pager = $this->get(PaginationFactory::class)->create($dql, $request);

        return $this->render('AppBundle:Category:show.html.twig', [
            'object' => $category,
            'pagination' => $pager
        ]);
    }
}
