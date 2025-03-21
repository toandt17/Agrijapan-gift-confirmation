@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Chỉnh Sửa Voucher</h4>
                    <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">Quay Lại</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="code" class="form-label">Mã Voucher</label>
                            <input type="text" class="form-control" id="code" value="{{ $voucher->code }}" readonly>
                            <small class="form-text text-muted">Mã voucher không thể thay đổi</small>
                        </div>

                        <div class="mb-3">
                            <label for="gift_name" class="form-label">Tên Quà Tặng <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('gift_name') is-invalid @enderror" id="gift_name" name="gift_name" value="{{ old('gift_name', $voucher->gift_name) }}" required>
                            @error('gift_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hình Ảnh Hiện Tại</label>
                            <div class="text-center mb-2">
                                <img src="{{ $voucher->image_url }}" alt="{{ $voucher->gift_name }}" class="img-fluid rounded" style="max-height: 150px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Thay Đổi Hình Ảnh</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Để trống nếu không muốn thay đổi hình ảnh. Chấp nhận: JPG, PNG, GIF (max: 2MB)</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trạng Thái</label>
                            <div>
                                @if ($voucher->is_redeemed)
                                    <span class="badge bg-danger">Đã Sử Dụng</span>
                                    <p class="form-text text-muted">Voucher đã được sử dụng vào {{ $voucher->redemption ? $voucher->redemption->redeemed_at->format('d/m/Y H:i') : 'N/A' }}</p>
                                @else
                                    <span class="badge bg-success">Chưa Sử Dụng</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Cập Nhật Voucher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
