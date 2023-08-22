<?php

declare(strict_types=1);

namespace App\Models;

use App\Queries\Role\GetAdminRoleCached;
use App\Queries\Role\GetUserRoleCached;
use Database\Factories\RoleFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Role
 *
 * @property string $RoleUlid
 * @property string $title
 * @property bool $base_role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereBaseRole($value)
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereDeletedAt($value)
 * @method static Builder|Role whereRoleUlid($value)
 * @method static Builder|Role whereTitle($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static RoleFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
final class Role extends Model
{
    use HasUlids;
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'RoleUlid';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['title','created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'RoleUlid',
        'title',
        'base_role'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class,'RoleUlid','RoleUlid');
    }


    public static function getAdminRoleCached(): Role
    {
        return GetAdminRoleCached::execute();
    }

    public static function getUserRoleCached(): Role
    {
        return GetUserRoleCached::execute();
    }


}
