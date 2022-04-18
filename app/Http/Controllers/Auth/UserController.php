<?php

namespace App\Http\Controllers\Auth;

use App\Enum\Status;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Auth\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        return User::paginate(env('PAGE_LIMIT'));
    }

    public function store(RegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name'              => $request->name,
                'username'          => $request->username ?? $request->email,
                'phone'             => $request->phone,
                'email'             => $request->email,
                'password'          => $request->password,
                'status'            => $request->status ?? Status::$ACTIVE,
            ];
            $user = User::create($data);

            if ($request->has('roles')) {
                $user->assignRole($request->roles);
            }

            DB::commit();

            return $this->sendSuccess(__('response.success.store', ['model' => 'User']), JsonResponse::HTTP_OK);

        } catch (\Exception $error) {
            DB::rollback();
            return $this->sendError($error->getMessage(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $error);
        }
    }
}
