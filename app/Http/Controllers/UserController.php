<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Service\Request\GetSkipAndLimitFromRequestService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Ulid;


class UserController extends Controller
{
    /**
     * @lrd:start
     * By default, the endpoint will return 10 records,
     * you can change the number of records returned by using the query string parameters skip and take.
     * @lrd:end
     * @LRDparam skip int
     * @LRDparam take int|max:100
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request):Response
    {

        [
            'skip' => $skip,
            'take' => $take
        ] = GetSkipAndLimitFromRequestService::execute($request);

        return response(
            User::all()->skip($skip)->take($take),
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
