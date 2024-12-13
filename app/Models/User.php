<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\CustomEmailVerification;
use App\Mail\CustomPasswordReset;
use App\Notifications\CustomResetPassword;
use App\Notifications\CustomVerifyEmailNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
        'auth_provider_id',
        'auth_provider',
        'device_limit',
    ];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmailNotification);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    public function purchases()
    {
        return $this->hasOne(Purchase::class);
    }

    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }

    public function isPremium()
    {
        return $this->purchases()->where('expires_at', '>', Carbon::now())->exists();
    }

    public function assignFreeTrial()
    {
        if ($this->isPremium()) {
            return;
        }
        if ($this->role === 'normal') {
            Purchase::create([
                'user_id' => $this->id,
                'plan_id' => 1,
                'started_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addDays(3),
                'is_active' => true,
            ]);
        }
    }

    public function getSubscriptionDeviceLimit()
    {
        if ($this->device_limit !== null) {
            return $this->device_limit;
        }

        $now = now();

        // Check if the user has any active subscriptions
        if (!$this->purchases()->where('expires_at', '>', $now)->exists()) {
            return 1; // No subscription (free service) = 1 device
        }

        // Get the user's active subscription
        $purchase = $this->purchases()->where('expires_at', '>', $now)->first();

        // Calculate the subscription duration in days
        $subscriptionDuration = $purchase->started_at->diffInDays($purchase->expires_at);

        // Determine the device limit based on the subscription duration
        switch (true) {
            case $subscriptionDuration <= 7:
                return 2; // Weekly subscription
            case $subscriptionDuration <= 31:
                return 3; // Monthly subscription
            case $subscriptionDuration <= 93:
                return 5; // Quarterly subscription
            case $subscriptionDuration > 93:
                return 10; // Half-year or longer subscription
            default:
                return 1; // Fallback in case no match is found
        }
    }

    public function canRegisterDevice($deviceId)
    {
        // Check if the device is already registered
        if ($this->devices()->where('device_id', $deviceId)->exists()) {
            return true; // Device already registered
        }

        // Check if the user has reached their device limit
        if ($this->devices()->count() >= $this->getSubscriptionDeviceLimit()) {
            return false; // Device limit reached
        }

        return true; // Device can be registered
    }

    public function registerDevice($deviceId, $devicedetails)
    {
        $existingDevice = UserDevice::where('device_id', $deviceId)->first();

        if ($existingDevice) {
            // Check if the device is already assigned to this user
            if ($existingDevice->user_id === $this->id) {
                return false; // Device already registered under the current user
            }

            // Reassign the device to the current user
            $existingDevice->update([
                'user_id' => $this->id,
                'device_token' => $devicedetails['device_token'],
                'device_name' => $devicedetails['device_name'],
                'ip_address' => $devicedetails['ip_address'],
                'platform' => $devicedetails['platform'],
            ]);

            return $existingDevice;
        }

        if ($this->devices()->where('device_id', $deviceId)->exists()) {
            return false; // Device already registered, do not save again
        }
        // Check if the device can be registered
        if ($this->canRegisterDevice($deviceId)) {
            return $this->devices()->create([
                'device_id' => $deviceId,
                'device_token' => $devicedetails['device_token'],
                'device_name' => $devicedetails['device_name'],
                'ip_address' => $devicedetails['ip_address'],
                'platform' => $devicedetails['platform'],
            ]);
        }

        return false;
    }

    public function unregisterDevice($deviceId)
    {
        // Delete the device from the user's registered devices
        return $this->devices()->where('device_id', $deviceId)->delete();
    }
}
