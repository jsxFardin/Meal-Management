<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request){
        return Role::paginate(env('PAGE_LIMIT'));
    }
}

