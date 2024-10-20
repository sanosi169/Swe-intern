<?php

namespace App\Interfaces;

interface BookRepositoryInterface 
{
    public function getAllBooks();
    public function getBookById($bookId);
    public function deleteBook($bookId);
    public function createBook(array $bookDetails);
    public function updateBook($bookId, array $newDetails);
    public function getFulfilledBooks();
}