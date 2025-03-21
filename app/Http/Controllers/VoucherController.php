<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Hiển thị thông tin voucher từ mã
     */
    public function show($code)
    {
        $voucher = Voucher::where('code', $code)->firstOrFail();
        return view('vouchers.show', compact('voucher'));
    }

    /**
     * Hiển thị thông tin voucher qua link chia sẻ công khai
     */
    public function share($code)
    {
        $voucher = Voucher::where('code', $code)->firstOrFail();
        return view('vouchers.share', compact('voucher'));
    }

    /**
     * Trang để xác minh mã voucher
     */
    public function verify($code = null)
    {
        // Nếu có mã truyền vào (từ QR code), chuyển hướng trực tiếp đến trang kiểm tra
        if ($code) {
            return $this->check(new Request(['code' => $code]));
        }

        return view('vouchers.verify', compact('code'));
    }

    /**
     * Kiểm tra mã voucher có hợp lệ không
     */
    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = $request->input('code');
        $voucher = Voucher::where('code', $code)->first();

        if (!$voucher) {
            return back()->with('error', 'Mã voucher không hợp lệ.');
        }

        if ($voucher->is_redeemed) {
            return back()->with('error', 'Voucher này đã được sử dụng trước đó.');
        }

        return view('vouchers.confirm', compact('voucher'));
    }
}
