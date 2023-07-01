<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return view('users.user_index',compact('user'));
    }

    public function deleteUser(Request $request)
    {
        $user_id = $request->input('delete_user');

        $user = User::find($user_id);
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully');
    }
}
