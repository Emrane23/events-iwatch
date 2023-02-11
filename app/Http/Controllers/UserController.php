<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
       $user = User::findOrFail(Auth::user()->id);
       $user->update($request->all());
       return response()->json(['user' => $user,], 200);
    }
}
