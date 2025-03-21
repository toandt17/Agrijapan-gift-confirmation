<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Carbon\Carbon;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Voucher::query();

        // Tìm kiếm theo mã voucher
        if ($request->has('search') && !empty($request->search)) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }

        // Lọc theo trạng thái
        if ($request->has('status') && !empty($request->status)) {
            if ($request->status === 'redeemed') {
                $query->where('is_redeemed', true);
            } elseif ($request->status === 'unredeemed') {
                $query->where('is_redeemed', false);
            }
        }

        // Lọc theo khoảng thời gian
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $vouchers = $query->latest()->paginate(10)->withQueryString();

        return view('admin.vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gift_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('vouchers', 'public');

        // Tạo mã voucher ngẫu nhiên
        $code = strtoupper(Str::random(8));

        // Tạo mã QR chỉ chứa mã số voucher, không phải URL
        // Tạo renderer cho QR code
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );

        // Tạo writer và sinh mã QR chỉ chứa mã voucher thôi
        $writer = new Writer($renderer);
        $qrCodeSvg = $writer->writeString($code);

        // Mã hóa QR code dạng SVG để lưu vào database
        $qrCode = base64_encode($qrCodeSvg);

        Voucher::create([
            'code' => $code,
            'qr_code' => $qrCode,
            'gift_name' => $request->gift_name,
            'image_url' => Storage::url($imagePath),
            'is_redeemed' => false,
        ]);

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Voucher đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.vouchers.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.vouchers.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'gift_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $voucher = Voucher::findOrFail($id);

        $voucher->gift_name = $request->gift_name;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($voucher->image_url) {
                $oldPath = str_replace('/storage/', '', $voucher->image_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('vouchers', 'public');
            $voucher->image_url = Storage::url($imagePath);
        }

        $voucher->save();

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Voucher đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::findOrFail($id);

        // Xóa ảnh voucher
        if ($voucher->image_url) {
            $path = str_replace('/storage/', '', $voucher->image_url);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $voucher->delete();

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Voucher đã được xóa thành công.');
    }
}
