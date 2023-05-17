<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function userAddress()
    {

        $user = User::find(auth()->id());
        return response()->json([
            'data'=> $user->address
        ],200);
    }
}
