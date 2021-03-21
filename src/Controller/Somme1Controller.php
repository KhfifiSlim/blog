<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Somme1Controller extends AbstractController
{
    /**
     * @Route("/somme1", name="somme1")
     */
    public function index(): Response
    {
        return $this->render('somme1/index.html.twig', [
            'controller_name' => 'Somme1Controller',
        ]);
    }
    /**
     * @Route("/somme1/{x}/{y}", name="somme1")
     */
    public function somme1($x,$y){
        $s=$x+$y;  
        return $this->render('somme1/index.html.twig', [
            'x' => $x,'y'=>$y,'s'=>$s
        ]);
    }
}
