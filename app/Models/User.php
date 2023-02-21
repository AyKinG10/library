<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'balance',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }
    public function booksLiked(){
        return $this->belongsToMany(Book::class,'user_book')
            ->withTimestamps();
    }
    public function booksSubs(){
        return $this->belongsToMany(Book::class,'book_subs')
            ->withPivot('month')
            ->withTimestamps();
    }
    public function booksRated(){
        return $this->belongsToMany(Book::class)
            ->withPivot('rating')
            ->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
