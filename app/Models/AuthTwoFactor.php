<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AuthTwoFactor.
 *
 * @property int $id
 * @property string $uuid
 * @property \datetime|null $created_at
 * @property \datetime|null $updated_at
 * @property \datetime|null $deleted_at
 * @property string|null $name
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor isEmail()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthTwoFactor whereUuid($value)
 * @mixin \Eloquent
 */
class AuthTwoFactor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_two_factor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * auth two factor with email.
     *
     * @param object $query
     * @return object
     */
    public function scopeIsEmail(object $query): object
    {
        return $query->where('auth_two_factor_id', 1);
    }

    /**
     * Relation user hasOne authTwoFactor (one to one).
     *
     * @return object
     */
    public function user(): object
    {
        return $this->hasOne(User::class, 'auth_two_factor_id');
    }
}
