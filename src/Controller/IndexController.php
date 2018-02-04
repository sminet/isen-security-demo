<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{

    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('index/index.html.twig', []);
    }
}
