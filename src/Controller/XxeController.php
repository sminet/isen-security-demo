<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;

class XxeController extends Controller
{

    /**
     * @Route("/xxe", name="xxe")
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $file = $request->files->get('import')->getPathname();
            
            $dom = new \DOMDocument();
            $dom->load($file, LIBXML_NOENT);
            $em = $this->getDoctrine()->getManager();
            
            $products = $dom->getElementsByTagName('product');
            foreach ($products as $product) {
                $entity = new Product();
                
                foreach ($product->childNodes as $attributes) {
                    $key = trim($attributes->nodeName);
                    $value = trim($attributes->nodeValue);
                    
                    switch ($key) {
                        case 'name':
                            $entity->setName($value);
                            break;
                        case 'price':
                            $entity->setPrice($value);
                            break;
                        case 'description':
                            $entity->setDescription($value);
                        default:
                    }
                }
                
                $em->persist($entity);
            }
            
            $em->flush();
            
            return $this->redirectToRoute('xxe');
        }
        
        return $this->render('xxe/index.html.twig', [
            'products' => $this->getDoctrine()
                ->getRepository(Product::class)
                ->findAll()
        ]);
    }
}
