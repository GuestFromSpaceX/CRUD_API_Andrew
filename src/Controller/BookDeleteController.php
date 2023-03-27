<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookDeleteController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/deletebook/{id}", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        // Поиск книги с заданным id в репозитории
        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id ' . $id);
        }

        // Удаление книги из EntityManager и сохранение изменений в базе данных
        $this->entityManager->remove($book);
        $this->entityManager->flush();

        return $this->json(['message' => 'Book deleted']);
    }
}