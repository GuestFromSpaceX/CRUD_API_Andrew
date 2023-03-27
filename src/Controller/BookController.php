<?php

// Определяем пространство имен для класса контроллера
namespace App\Controller;

// Импортируем необходимые классы
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Определяем класс контроллера
class BookController extends AbstractController
{
    // Объявляем приватное свойство для хранения экземпляра менеджера сущностей
    private EntityManagerInterface $entityManager;

    // Определяем конструктор для инициализации свойства менеджера сущностей
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/getbook/{id}", methods={"GET"})
     */
    // Определяем метод контроллера для получения данных о книге по её ID
    public function getItem(int $id): Response
    {
        // Получаем данные о книге из репозитория
        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id ' . $id);
        }

        // Формируем массив с данными о книге
        $data = [
            'id' => $book->getId(),
            'author' => $book->getAuthor(),
            'title' => $book->getTitle(),
        ];

        // Возвращаем данные о книге в формате JSON
        return $this->json($data);
    }
}

