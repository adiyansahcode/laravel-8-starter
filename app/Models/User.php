<?php

declare(strict_types=1);

namespace App\Models;

use App\Notifications\AuthTwoFactorCodeNotification;
use App\Notifications\AuthTwoFactorCodeNotificationQueue;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\ResetPasswordNotificationQueue;
use App\Notifications\VerifyEmailNotification;
use App\Notifications\VerifyEmailNotificationQueue;
use App\Notifications\FirebaseNotification;
use App\Notifications\FirebaseNotificationQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $uuid
 * @property \datetime|null $created_at
 * @property \datetime|null $updated_at
 * @property \datetime|null $deleted_at
 * @property string|null $fullname
 * @property string|null $username
 * @property string|null $email
 * @property string|null $phone
 * @property \datetime|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \datetime|null $last_login_at
 * @property string|null $last_login_ip
 * @property string|null $two_factor_code
 * @property \datetime|null $two_factor_expires_at
 * @property int|null $auth_two_factor_id
 * @property string|null $image
 * @property string|null $image_url
 * @property-read \App\Models\AuthTwoFactor|null $authTwoFactor
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAuthTwoFactorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUuid($value)
 * @mixin \Eloquent
 */
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
        'fcm_token',
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

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        // $this->notify(new ResetPasswordNotification($token));
        $this->notify(new ResetPasswordNotificationQueue($token));
    }

    /**
     * Send a email verify notification to the user.
     *
     * @return void
     */
    public function sendEmailVerificationNotification(): void
    {
        // $this->notify(new VerifyEmailNotification());
        $this->notify(new VerifyEmailNotificationQueue());
    }

    /**
     * Send a OTP notification to the user.
     *
     * @return void
     */
    public function sendTwoFactorCodeNotification(): void
    {
        if (isset($this->authTwoFactor)) {
            $this->generateTwoFactorCode();
            // $this->notify(new AuthTwoFactorCodeNotification());
            $this->notify(new AuthTwoFactorCodeNotificationQueue());
        }
    }

    /**
     * Generate Two Factor Code (OTP) for login.
     *
     * @return void
     */
    public function generateTwoFactorCode(): void
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    /**
     * Reset Two Factor Code (OTP).
     *
     * @return void
     */
    public function resetTwoFactorCode(): void
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    /**
     * get image of user.
     *
     * @return string
     */
    public function getImage(): string
    {
        $url = $this->image_url;
        if ($url) {
            $headers = get_headers($url);
            $status = stripos($headers[0], '200 OK') ? true : false;
            if ($status === true) {
                return $this->image_url;
            }
        }

        return asset('storage/images/profile-pic-male.jpg');
    }

    /**
     * Relation authTwoFactor belongsTo user (one to one).
     *
     * @return object
     */
    public function authTwoFactor(): object
    {
        return $this->belongsTo(AuthTwoFactor::class, 'auth_two_factor_id');
    }

    /**
     * Send a OTP notification to the user.
     *
     * @return void
     */
    public function updateFcmToken(string $token): void
    {
        $fcm = config('firebase.fcm');
        if ($fcm) {
            $this->timestamps = false;
            $this->fcm_token = $token;
            $this->save();
        }
    }

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }

    /**
     * Send a Firebase notification to the user.
     *
     * @return void
     */
    public function sendFirebaseNotification(string $title, string $message): void
    {
        $fcm = config('firebase.fcm');
        if ($fcm) {
            // $this->notify(new FirebaseNotification());
            $this->notify(new FirebaseNotificationQueue($title, $message));
        }
    }
}
