<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;


    public function watch(User $user,Book $book){
        $bookSub=$user->booksSubs()->where('book_id',$book->id)->first();
        $nowTime=Carbon::now()->addHours(6);
        return
            $bookSub != null
            &&
            $bookSub->pivot->created_at->addMinutes($bookSub->pivot->month)->gte($nowTime);
    }

    public function userView(User $user)
    {
        return $user->role->name == 'user';
    }

    public function viewAny(User $user)
    {
        return $user->role->name=='admin';
    }

    public function view(User $user)
    {
        return $user->role->name=='moderator';
    }

    public function create(User $user)
    {
        return $user->role->name =='writer';
    }

    public function update(User $user)
    {
        return $user->role->name =='writer' || $user->role->name != 'moderator' || $user->role->name != 'admin';
    }

    public function delete(User $user, Book $book)
    {
        return ($user->id == $book->user_id) || $user->role->name != 'moderator';
    }

    public function restore(User $user, Book $book)
    {
        //
    }

    public function forceDelete(User $user, Book $book)
    {
        //
    }
}
