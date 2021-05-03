<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'fullname',
        'username',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'last_login_at',
        'last_login_ip',
        'two_factor_code',
        'two_factor_expires_at',
        'auth_two_factor_id',
        'image',
        'image_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
        'last_login_at' => 'datetime:Y-m-d H:i:s',
        'two_factor_expires_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    // User Model
    public function getImage()
    {
        if ($this->imageUrlExists($this->image_url)) {
            return $this->image_url;
        } else {
            return asset('storage/images/profile-pic-male.jpg');
        }
    }

    public function imageUrlExists(?string $url): bool
    {
        if (empty($url)) {
            return false;
        }

        $headers = get_headers($url);

        return stripos($headers[0], "200 OK") ? true : false;
    }

    public function authTwoFactor()
    {
        return $this->belongsTo(AuthTwoFactor::class, 'auth_two_factor_id');
    }
}
