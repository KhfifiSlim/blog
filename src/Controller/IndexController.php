<?php

namespace App\Controller;
use App\Entity\Article;

use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /** * @Route("/article/new", name="new_article") * Method({"GET", "POST"}) */ public function new(Request $request) { $article = new Article(); $form = $this->createForm(ArticleType::class,$article); $form->handleRequest($request); if($form->isSubmitted() && $form->isValid()) { $article = $form->getData(); $entityManager = $this->getDoctrine()->getManager(); $entityManager->persist($article); $entityManager->flush(); 
       return $this->redirectToRoute('show_article');
    } return $this->render('index/new.html.twig',['form' => $form->createView()]); }

    /** * @Route("/article/edit/{id}", name="edit_article") * Method({"GET", "POST"})
*/ 
public function edit(Request $request, $id) { $article = new Article(); $article = $this->getDoctrine()->getRepository(Article::class)->find($id); $form = $this->createForm(ArticleType::class,$article); $form->handleRequest($request); if($form->isSubmitted() && $form->isValid()) { $entityManager = $this->getDoctrine()->getManager(); $entityManager->flush();
    return $this->redirectToRoute('show_article'); 
    } return $this->render('index/edit.html.twig', ['form' => $form->createView()]); }

    /**
     * @Route("/list", name="show_article", methods={"GET"})
     */
    public function show(ArticleRepository $articlerepository): Response
    {
        return $this->render('index/list.html.twig', [
            'article' => $articlerepository->findAll(),
        ]);
    }

}
