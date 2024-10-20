<?php
namespace App\Repositories;
use App\Interfaces\BorrowingRepositoryInterface;
use App\Models\Borrowing;

class BorrowingRepository implements BorrowingRepositoryInterface
{
    public function borrowBook($bookId, $user)
    {
        return Borrowing::create([
            'book_id' => $bookId,
            'user_id' => $user,
            'borrow_date' => now(),
        ]);
    }

    public function returnBook($borrowId)
    {
        $borrowing = Borrowing::find($borrowId);
        if ($borrowing) {
            $borrowing->return_date = now();
            $borrowing->save();
            return $borrowing;
        }
        return null;
    }

    public function getUserBorrowedBooks($userId)
    {
        return Borrowing::where('user_id', $userId)->whereNull('return_date')->get();
    }

    public function getAllBorrowedBooks()
    {
        return Borrowing::whereNull('return_date')->get();
    }

    public function getCurrentlyBorrowedBooks()
{
    return Borrowing::with('book') 
        ->whereNull('return_date') 
        ->get();
}

public function getMostPopularBooks($limit = 10)
{
    return Borrowing::select('book_id', \DB::raw('count(*) as borrow_count'))
        ->groupBy('book_id')
        ->orderBy('borrow_count', 'desc')
        ->limit($limit)
        ->with('book') 
        ->get();
}

}
