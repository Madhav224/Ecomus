<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Administrator;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
        'phone_verified_at' => 'datetime',
    ];

    public $appends = [
        'profile_image_url'
    ];

    public function Address()
    {
        return $this->hasMany(UserAddress::class);
    }
    public function WishList()
    {
        return $this->hasMany(WishList::class);
    }
    public function ProductReview()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function AppliedCoupon()
    {
        return $this->hasMany(AppliedCoupon::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
    public function PaymentHistory()
    {
        return $this->hasMany(PaymentHistory::class, 'user_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(ModuleCountry::class, 'user_country_id');
    }
    public function state()
    {
        return $this->belongsTo(ModuleState::class, 'user_state_id');
    }
    public function city()
    {
        return $this->belongsTo(ModuleCity::class, 'user_city_id');
    }

    // public function getEmailAttribute($value)
    // {
    //     return decrypt_to($value);
    // }
    public function getPhoneNoAttribute($value)
    {
        return decrypt_to($value);
    }
    public function getProfileImageUrlAttribute($value)
    {
        return asset(!empty($this->profile_image) && file_exists(public_path($this->profile_image)) ? $this->profile_image : 'upload/default.webp');
    }
}
