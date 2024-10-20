<?php

namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface 
{
    public function getAllBooks() 
    {
        return Book::all();
    }

    public function getBookById($bookId) 
    {
        return Book::findOrFail($bookId);
    }

    public function deleteBook($bookId) 
    {
        Book::destroy($bookId);
    }

    public function createBook(array $bookDetails) 
    {
        return Book::create($bookDetails);
    }

    public function updateBook($bookId, array $newDetails) 
    {
        return Book::whereId($bookId)->update($newDetails);
    }

    public function getFulfilledBooks() 
    {
        return Book::where('is_fulfilled', true);
    }
}