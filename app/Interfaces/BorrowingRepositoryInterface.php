<?php
namespace App\Interfaces;

interface BorrowingRepositoryInterface
{
    public function borrowBook($bookId, $userId); // Corrected method name
    public function returnBook($borrowId);
    public function getUserBorrowedBooks($userId);
    public function getAllBorrowedBooks();
}
