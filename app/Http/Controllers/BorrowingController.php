<?php

namespace App\Http\Controllers;
use App\Interfaces\BorrowingRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\BorrowingRepository;
use App\Traits\ApiResponse;
use App\Models\Borrowing;

class BorrowingController extends Controller
{
    use ApiResponse;

       private $borrowingRepository;

    public function __construct(BorrowingRepositoryInterface $borrowingRepository)
    {
        $this->borrowingRepository = $borrowingRepository;
    }
    public function borrowBook(Request $request,$bookId)
    {
        $user = auth()->user()->id;

        $bookBorrow=$this->borrowingRepository->borrowBook($bookId,$user);
            // $bookBorrow = new BookBorrow();
            // $bookBorrow->user_id = $user; // تخزين user_id
            // $bookBorrow->book_id = $request->book_id; // تخزين book_id
            // $bookBorrow->borrowed_at = now();
            // $bookBorrow->save(); 
    
            return response()->json(['message' => 'Book borrowed successfully', 'data' => $bookBorrow], 201);
       


    
        // return response()->json(['error' => 'Unauthorized'], 401);
    }
    

    public function returnBook($borrowId)
    {

        $borrowing = $this->borrowingRepository->returnBook($borrowId);

            return $this->apiresponse($borrowing, 'Book returned successfully', 200);
    }

    public function userBorrowedBooks($userId)
    {
        $books = $this->borrowingRepository->getUserBorrowedBooks($userId);
        return $this->apiresponse($books, 'User borrowed books retrieved successfully', 200);
    }

    public function allBorrowedBooks()
    {
        $books = $this->borrowingRepository->getAllBorrowedBooks();
        return $this->apiresponse($books, 'All borrowed books retrieved successfully', 200);
    }

    public function borrowedReport()
{
    try {
        // Fetch currently borrowed books
        $borrowedBooks = $this->borrowingRepository->getCurrentlyBorrowedBooks();

        return $this->apiresponse($borrowedBooks, 'Currently borrowed books retrieved successfully', 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve borrowed books report: ' . $e->getMessage()], 400);
    }
}
public function popularReport()
{
    try {
        // Fetch the most popular books, you might want to define how "popularity" is determined (e.g., number of borrows)
        $popularBooks = $this->borrowingRepository->getMostPopularBooks();

        return $this->apiresponse($popularBooks, 'Most popular books retrieved successfully', 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve popular books report: ' . $e->getMessage()], 400);
    }
}
}
