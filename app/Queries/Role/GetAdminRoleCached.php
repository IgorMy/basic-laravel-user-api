<?php

namespace App\Queries\Role;

use App\Models\Role;
use Illuminate\Support\Facades\Cache;

final class GetAdminRoleCached
{

    public static function execute(): Role
    {
        return Cache::remember('admin_role', 60 * 60 * 24, function () {
            return Role::where([
                 ['base_role', '=', true],
                 ['title', '=', 'admin']
            ])->first();
        });
    }

}
