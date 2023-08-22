<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index():Response
    {
        return response(
            Role::all(),
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
        return response()->json([
            'role' => Role::where('RoleUlid', $RoleUlid)->firstOrFail(),
            Response::HTTP_OK
        ]);
    }

    public function update(UpdateRoleRequest $request, string $RoleUlid):Response
    {
        return response(
            Role::where('RoleUlid', $RoleUlid)->update($request->validated()),
            Response::HTTP_OK
        );
    }

    public function destroy(string $RoleUlid):Response
    {
        return response(
            Role::where('RoleUlid', $RoleUlid)->delete(),
            Response::HTTP_OK
        );
    }
}
