<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'qr_code',
        'gift_name',
        'image_url',
        'is_redeemed',
    ];

    protected $casts = [
        'is_redeemed' => 'boolean',
    ];

    /**
     * Lấy thông tin về lần sử dụng voucher
     */
    public function redemption(): HasOne
    {
        return $this->hasOne(VoucherRedemption::class);
    }
}
