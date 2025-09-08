<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;


class Cart extends Model
{
    protected $guarded = [];

    protected $appends = [
        'subtotal',
        'total',
        'discount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function child()
    {
        return $this->hasMany(CartChild::class);
    }

    public function AppliedCoupon()
    {
        return $this->hasMany(AppliedCoupon::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->child->sum('total_price') ?? 0;
    }
    public function getDiscountAttribute()
    {
        $coupon = $this->AppliedCoupon()->latest()->first()?->Coupon;

        return $coupon
            ? ($coupon->value_type == 'in_amount'
                ? $coupon->value
                : ($this->subtotal * $coupon->value / 100))
            : 0;
    }
    public function getTotalAttribute()
    {
        return $this->subtotal - $this->discount ?? 0;
    }

    public function availableCoupons()
    {
        $user = $this->user;
        $userCoupon = $user?->AppliedCoupon()->orderByDesc('id')->exists();
        $todayDate = Carbon::today();
        if (!$userCoupon) {
            return Coupon::withCount('order')
                ->where('min_amount', '<=', $this->subtotal)
                ->where('coupon_validate_on', 'cart')
                ->whereDate('start_date', '<=', $todayDate)
                ->whereDate('end_date', '>=', $todayDate)
                ->when($user, function ($q) use ($user) {
                    if ($user?->order()->first()) {
                        $q->where('for_new_member', '0');
                    }
                    $usedCouponIds = $user->order()
                        ->whereNotNull('coupon_id')
                        ->pluck('coupon_id')
                        ->toArray();
                    $q->where(function ($sub) use ($usedCouponIds) {
                        $sub->where('user_usage_type', 'multiple')
                            ->orWhere(function ($once) use ($usedCouponIds) {
                                $once->where('user_usage_type', 'once')
                                    ->whereNotIn('id', $usedCouponIds);
                            });
                    });
                })
                ->having('order_count', '<', \DB::raw('use_limit'))
                ->get();
        }

        return collect();
    }



}
