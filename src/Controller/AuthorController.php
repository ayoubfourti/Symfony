<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    private $authors;
    public function __construct(){
        $this->authors=[
        ['id' => 1, 'picture' =>'/img/image/th.png','username' => 'Victor Hugo', 'email' =>'victor.hugo@gmail.com ', 'nb_books' => 100],
        ['id' => 2, 'picture' => '/img/image/vh.png','username' => ' William Shakespeare', 'email' =>' william.shakespeare@gmail.com', 'nb_books' => 200 ],
        ['id' => 3, 'picture' => '/img/image/ws.png','username' => 'Taha Hussein', 'email' =>'taha.hussein@gmail.com', 'nb_books' => 300]
             ];
    }
    #[Route('/author', name: 'app_author',methods:['GET'])]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/showAuthor/{name}', name: 'app_author1',defaults:['name'=>'victor hugo'],methods:['GET'])]
    public function showAuthor(string $name): Response
    {
        return $this->render('author/showAuthor.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/listAuthor', name: 'app_author1',methods:['GET'])]
    public function listAuthor(): Response
    {

        return $this->render('author/listAuthor.html.twig ', [
            'authors'=>$this-> authors
            
  
        ]);
    }

#[Route('/author/details/{id}', name: 'app_author_details', methods: ['GET'])]
public function authorDetails(int $id): Response
{
    $author = null;
    
    foreach ($this->authors as $a) {
        if ($a['id'] === $id) {
            $author = $a;
            break;
        }
    }

    if (!$author) {
        throw $this->createNotFoundException('Auteur non trouvé');
    }

    return $this->render('author/showAuthor.html.twig', [ // Changer ici
        'author' => $author
    ]);
}


    
}
