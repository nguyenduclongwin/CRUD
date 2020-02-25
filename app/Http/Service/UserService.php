<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\User_friend;
use App\Constants;

class UserService
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getUsers()
    {
        $follow_id = User_friend::where('friend_id', '=', Auth::user()->id)->get();
        foreach ($follow_id as $value) {
            $whereData[] = $value->user_id;
        }
        $whereData[] = Auth::user()->id;
        return User::latest()->whereNotIn('id', $whereData)->get();
    }
    public function getUser()
    {
        return Auth::user();
    }
    public function createRelationship($request)
    {
        $request['friend_id'] = Auth::user()->id;
        return $relationShip = User_friend::create($request);
    }
    public function getFriendUser()
    {
        return User::join('User_friends', 'id', '=', 'friend_id')
            ->where('user_id', '=', Auth::user()->id)->get();
    }
}
