<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookPutController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/updatebook/{id}", methods={"PUT"})
     */
    public function put(Request $request, $id): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id ' . $id);
        }

        $data = json_decode($request->getContent(), true);

        $author = isset($data['author']) ? $data['author'] : null;
        $title = isset($data['title']) ? $data['title'] : null;

        $book->setAuthor($author);
        $book->setTitle($title);

        // Сохранение изменений в базе данных
        $this->entityManager->flush();

        // Возврат JSON-ответа с id обновленной книги
        return $this->json(['id' => $book->getId()]);
    }

}
