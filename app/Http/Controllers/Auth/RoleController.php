<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends BaseController
{
    public function index(){
        $roles = Role::all();
        return $this->sendSuccess(__('Data Found'), JsonResponse::HTTP_OK, $roles);
    }
}
