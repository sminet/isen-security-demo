<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use App\Entity\User;
use App\Entity\Article;

class SqlInjectionController extends Controller
{

    /**
     * @Route("/sql_injection", name="sql_injection_login")
     */
    public function login(Request $request)
    {
        $logged = null;
        $message = null;
        
        if ($request->isMethod('post')) {
            $username = $request->get('username');
            $password = $request->get('password');
            
            $ctx = $this->getDoctrine()->getConnection();
            $stmt = $ctx->executeQuery("SELECT * FROM user WHERE username='${username}' AND password='${password}'");
            $user = $stmt->fetch();
            
            if ($user === false) {
                $message = [
                    'level' => 'danger',
                    'text' => 'Incorrect credentials'
                ];
            } else {
                $message = [
                    'level' => 'success',
                    'text' => 'Welcome ' . $user['username']
                ];
            }
        }
        
        return $this->render('sql-injection/login.html.twig', [
            'message' => $message
        ]);
    }

    /**
     * @Route("/sql_injection_advanced", name="sql_injection_advanced")
     */
    public function advanced(Request $request)
    {
        // récupère tous les articles
        return $this->render('sql-injection/advanced.html.twig', [
            'articles' => $this->getDoctrine()
                ->getManager()
                ->getRepository(Article::class)
                ->findAll()
        ]);
    }

    /**
     * @Route("/sql_injection_article/{id}", name="sql_injection_article")
     */
    public function article(string $id)
    {
        $ctx = $this->getDoctrine()->getConnection();
        $stmt = $ctx->executeQuery("SELECT date, title, content FROM article WHERE id=${id}");
        $article = $stmt->fetch();
        
        // récupère tous les articles
        return $this->render('sql-injection/article.html.twig', [
            'article' => $article
        ]);
    }
}
