<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Twilio\Rest\Client;


class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone'
    ];


    const SUPER_ADMIN = "Super Admin";
    const ADMIN = "Admin";
    const USER = "User";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the Full Name.
     *
     * @return Attribute
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['first_name'] . " " . $attributes['last_name'],
        );
    }

    /**
     * Get the name's initials.
     *
     * @return Attribute
     */
    protected function nameInitials(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => ucwords($attributes['first_name'][0] . $attributes['last_name'][0]),
        );
    }


    /**
     * generate OTP and send sms
     *
     * @return mixed
     */
    public function generateCode()
    {
        $code = rand(100000, 999999);

        UserCode::updateOrCreate([
            'user_id' => auth()->user()->id,
            'code' => $code
        ]);

        $receiverNumber = auth()->user()->phone;
        $message = "Berndorf Bäderbau Dashboard: $code The Code expires in 10 minutes. Don't share this code with anyone.";

        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $number,
                'body' => $message]);

        } catch (\Exception $e) {
            Log::error($e);
        }
    }

}
