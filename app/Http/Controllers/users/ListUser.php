<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ListUser extends Controller
{
    public function index()
    {
        $data = User::all();
        $roles = Role::all();
        return view('content.users.list.index', compact('data', 'roles'));
    }
}
