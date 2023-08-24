<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Service\Request\GetSkipAndLimitFromRequestService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * @lrd:start
     * By default, the endpoint will return 10 records,
     * you can change the number of records returned by using the query string parameters skip and take.
     * @lrd:end
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
            new RoleResource(
                Role::skip($skip)->take($take)->get(),
                Role::count()
            ),
            Response::HTTP_OK
        );
    }

    public function store(CreateRoleRequest $request):Response
    {
        return response(
            Role::factory()->create($request->validated()),
            Response::HTTP_CREATED
        );
    }

    public function show(string $RoleUlid):Response
    {
        return response(
            Role::where('RoleUlid', $RoleUlid)->firstOrFail(),
            Response::HTTP_OK
        );
    }

    public function update(UpdateRoleRequest $request, string $RoleUlid):Response
    {

        $role = Role::where('RoleUlid', $RoleUlid)->firstOrFail();

        if($role->base_role){
            return response(
                'Cannot update base role',
                Response::HTTP_BAD_REQUEST
            );
        }

        $role->update($request->validated());
        return response(
            $role,
            Response::HTTP_OK
        );
    }

    public function destroy(string $RoleUlid):Response
    {

        $role = Role::where('RoleUlid', $RoleUlid)->firstOrFail();

        if($role->base_role){
            return response(
                'Cannot delete base role',
                Response::HTTP_BAD_REQUEST
            );
        }else{
            $role->delete();
        }

        return response(
            null,
            Response::HTTP_OK
        );
    }
}
