<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookPostController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/addbook", methods={"POST"})
     */
    public function post(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $book = new Book();
        $book->setAuthor($data['author']);
        $book->setTitle($data['title']);

        // Добавление объекта Book в EntityManager
        $this->entityManager->persist($book);

        // Сохранение изменений в базе данных
        $this->entityManager->flush();

        return $this->json(['id' => $book->getId()]);
    }

}