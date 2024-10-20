<?php

namespace App\Http\Controllers;

use App\Interfaces\BookRepositoryInterface;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Traits\ApiResponse;
use  App\Http\Requests\Book\BookStoreRequest;

class BookController extends Controller
{
   use ApiResponse;

   private BookRepositoryInterface $bookRepository;
   public function __construct(BookRepositoryInterface $bookRepository) 
    {
        $this->bookRepository = $bookRepository;
    }

   public function index(){

      try {
         $books = $this->bookRepository->getAllBooks(); 
 
         return $this->apiresponse($books, 'ok', 200);
     } catch (\Exception $e) {
         return $this->apiresponse(null, 'error' . $e->getMessage(), 500);
     }
   }

   public function store(BookStoreRequest $request){
  try{


      $book=$this->bookRepository->createBook($request->validated());

      return $this->apiresponse($book, 'Book added successfully', 201);

   } catch (\Exception $e) {
      return $this->apiresponse(null, 'error' . $e->getMessage(), 500);
  }

    
     

       }

       public function update(Request $request,$id){

        try {
         $book = Book::findOrFail($id);
         $newDetails=[ 'title'     => $request->filled('title') ? $request->title : $book->title,
         'author'    => $request->filled('author') ? $request->author : $book->author,
         'publisher' => $request->filled('publisher') ? $request->publisher : $book->publisher,
         'isbn'      => $request->filled('isbn') ? $request->isbn : $book->isbn,
         'status'    => $request->filled('status') ? $request->status : $book->status,];

    
         
      $upadtebook=$this->bookRepository->updateBook($book,$newDetails);
         // return $this->apiresponse($books, 'Book added successfully', 201);
         return response()->json('error', 200);


         }catch(\Exception $e){
            return $this->apiresponse(null, 'error'. $e->getMessage(), 500);

         }
       }

       public function delete(Request $request,$id){

         try{
            $bookId=Book::findorFail($id);
            $deletedbook=$this->bookRepository->deleteBook($bookId);
            return response()->json([
               'message' => 'Book deleted successfully',
               'data' => $deletedItem // Assuming you have the deleted item to return
           ]);
         }catch(\Exception $e){
            return $this->apiresponse( null,'error' . $e->getMessage(), 500);

         }
       }
}
