<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\User;

class SessionFixationController extends Controller
{

    /**
     * @Route("/session_fixation", name="session_fixation")
     */
    public function index(SessionInterface $session)
    {
        $session->set('started', true);
        
        return $this->render('session-fixation/index.html.twig', [
            'session' => $session,
            'users' => $this->getDoctrine()
                ->getRepository(User::class)
                ->findAll()
        ]);
    }

    /**
     * @Route("/session_fixation/auth", name="session_fixation_auth")
     */
    public function auth(Request $request, SessionInterface $session)
    {
        $message = null;
        
        if ($request->isMethod('post')) {
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                'username' => $request->get('username'),
                'password' => $request->get('password')
            ]);
            
            if ($user === null) {
                $message = [
                    'level' => 'danger',
                    'text' => 'Incorrect credentials'
                ];
            } else {
                $message = [
                    'level' => 'success',
                    'text' => 'Logged as ' . $user->getUsername()
                ];
                
                $session->set('username', $user->getUsername());
                $session->set('firstname', $user->getFirstname());
                $session->set('name', $user->getName());
            }
        }
        
        return $this->render('session-fixation/auth.html.twig', [
            'message' => $message,
            'session' => $session
        ]);
    }
}
