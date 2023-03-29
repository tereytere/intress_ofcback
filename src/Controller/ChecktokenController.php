<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;


class ChecktokenController extends AbstractController
{
    /**
    * @Route("/checktoken", name="check_token")
    */
    public function checktoken(Request $request, UserRepository $userRepository): Response
    {

        //$em = $this->getDoctrine()->getManager();

        if($request->query->get('bearer')) {
            $token = $request->query->get('bearer');
        }else {
            return $this->redirectToRoute('app_login');
        }

        $tokenParts = explode(".", $token);  
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

        //dump($jwtPayload);die;
    
        $user = $userRepository->findOneByEmail($jwtPayload->username);
        
        //dump($user);die;
        $userRepository->remove($user);

        //dump($user->getRoles());die;
        if(!$user) {
            return $this->redirectToRoute('app_login');
        }

        $response = new Response();
        $response->setContent(json_encode([
            'auth' => 'Logado',
            'email' => $user->getEmail()
        ]));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('pass', 'ok');
        $response->headers->set('email', $user->getEmail());
        
        // TODO: Revisar cookie
        $response->headers->setCookie(new Cookie('Authorization', $token));
        $response->headers->setCookie(new Cookie('BEARER', $token));
        
        return $response; 
    }

    /**
    * @Route("/api/test", name="check_api")
    */
    public function checktoken2(Request $request, UserRepository $userRepository): Response
    {
        return $this->json(['pass'=> 'Acceso permitido por token'], $status = 200, $headers = ['Access-Control-Allow-Origin'=>'*']);
    }

}
