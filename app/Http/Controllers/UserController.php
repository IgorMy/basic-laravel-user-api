<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Ulid;


class UserController extends Controller
{
    public function index():Response
    {
        return response(
            User::all(),
            Response::HTTP_OK
        );
    }

    public function store(CreateUserRequest $request):Response
    {
        return response(
            User::factory()->create($request->validated()),
            Response::HTTP_CREATED
        );
    }

    public function show(string $UsersUlid):Response
    {

        return response(
            User::where('UsersUlid', $UsersUlid)->firstOrFail(),
            Response::HTTP_OK
        );
    }

    public function update(UpdateUserRequest $request, string $UsersUlid):Response
    {

        $user = User::where('UsersUlid', $UsersUlid)->firstOrFail();

        if(
            $user->email == env('ADMIN_EMAIL', 'admin@admin.admin') &&
            $request->has('RoleUlid')
        ){
            return response(
                'Cannot update admin user role',
                Response::HTTP_BAD_REQUEST
            );
        }

        if($request->has('password')){
            $request->merge([
                'password' => bcrypt($request->input('password'))
            ]);
        }

        $user->update($request->validated());
        return response(
            $user,
            Response::HTTP_OK
        );
    }

    public function destroy(string $UsersUlid):Response
    {

        $user = User::where('UsersUlid', $UsersUlid)->firstOrFail();

        if($user->email == env('ADMIN_EMAIL', 'admin@admin.admin')){
            return response(
                'Cannot delete admin user',
                Response::HTTP_BAD_REQUEST
            );
        }else{
            $user->delete();
        }

        return response(
            null,
            Response::HTTP_OK
        );
    }
}
