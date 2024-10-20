<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title','author','publisher','isbn','status'];
    protected $table='books';

    public function Borrowing(){
        return $this->hasMany(Borrowing::class);
    }
}
