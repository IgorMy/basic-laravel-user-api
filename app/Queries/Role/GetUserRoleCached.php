<?php

declare(strict_types=1);

namespace App\Queries\Role;

use App\Models\Role;
use Illuminate\Support\Facades\Cache;

final class GetUserRoleCached
{
    public static function execute(): Role
    {
        return Cache::remember('user_role', 60 * 60 * 24, function () {
            return Role::where([
                ['base_role', '=', true],
                ['title', '=', 'user']
            ])->first();
        });
    }
}
