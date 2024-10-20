<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;
    protected $fillable = ['borrow_date','return_date','user_id','book_id'];
    protected $table='borrowings';


    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Book(){
        return $this->belongsTo(Book::class);
    }
}
