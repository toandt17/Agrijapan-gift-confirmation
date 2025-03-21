<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherRedemption extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'redeemed_at',
    ];

    protected $casts = [
        'redeemed_at' => 'datetime',
    ];

    /**
     * Lấy thông tin voucher đã sử dụng
     */
    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }
}
