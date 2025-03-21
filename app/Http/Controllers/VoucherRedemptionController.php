<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\VoucherRedemption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherRedemptionController extends Controller
{
    /**
     * Thực hiện đổi voucher
     */
    public function redeem(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = $request->input('code');

        try {
            DB::beginTransaction();

            $voucher = Voucher::where('code', $code)->lockForUpdate()->first();

            if (!$voucher) {
                return back()->with('error', 'Mã voucher không hợp lệ.');
            }

            if ($voucher->is_redeemed) {
                return back()->with('error', 'Voucher này đã được sử dụng trước đó.');
            }

            // Đánh dấu voucher đã được sử dụng
            $voucher->is_redeemed = true;
            $voucher->save();

            // Lưu thông tin đổi voucher
            VoucherRedemption::create([
                'voucher_id' => $voucher->id,
            ]);

            DB::commit();

            return redirect()->route('voucher.redeemed', $voucher->code)
                ->with('success', 'Voucher đã được đổi thành công.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi khi đổi voucher.');
        }
    }

    /**
     * Hiển thị trang thông báo đã đổi voucher thành công
     */
    public function redeemed($code)
    {
        $voucher = Voucher::where('code', $code)->firstOrFail();
        return view('vouchers.redeemed', compact('voucher'));
    }
}
