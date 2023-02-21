<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['content','book_id','user_id'];

    use HasFactory;

    public function book(){

        return $this->belongsTo(Book::class);

    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
