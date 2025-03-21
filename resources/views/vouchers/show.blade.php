@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-ticket-perforated-fill me-2"></i>
                        Chi Tiết Voucher Quà Tặng
                    </h4>
                </div>

                <div class="card-body p-3 p-md-4">
                    <div class="text-center mb-4">
                        <h3 class="text-primary mb-3">{{ $voucher->gift_name }}</h3>

                        <div class="gift-image-container mb-3">
                            <img src="{{ $voucher->image_url }}" alt="{{ $voucher->gift_name }}" class="img-fluid rounded" style="max-height: 280px;">
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-center">
                            @if ($voucher->is_redeemed)
                                <div class="alert alert-danger mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-exclamation-triangle-fill text-danger me-3" style="font-size: 1.75rem;"></i>
                                        <div class="text-start">
                                            <h5 class="alert-heading">Voucher đã sử dụng</h5>
                                            <p class="mb-0">Voucher đã được đổi quà vào {{ $voucher->redemption ? $voucher->redemption->redeemed_at->format('d/m/Y H:i') : 'thời gian không xác định' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-success mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 1.75rem;"></i>
                                        <div class="text-start">
                                            <h5 class="alert-heading">Voucher hợp lệ</h5>
                                            <p class="mb-0">Voucher này có thể được sử dụng để đổi quà tặng</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Mobile View -->
                    <div class="d-md-none">
                        <div class="card border mb-4">
                            <div class="card-body p-3">
                                <h5 class="card-title text-primary text-center mb-3">
                                    <i class="bi bi-upc-scan me-2"></i>Mã Voucher
                                </h5>
                                <div class="voucher-code mb-3 fs-5">{{ $voucher->code }}</div>
                                <div class="text-center">
                                    <div class="qr-container mb-3 mx-auto">
                                        <img src="data:image/svg+xml;base64,{{ $voucher->qr_code }}" alt="QR Code" class="img-fluid" style="max-width: 150px;">
                                    </div>
                                </div>
                                <p class="text-muted text-center small mb-0">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Cung cấp mã này hoặc quét mã QR để đổi quà
                                </p>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('voucher.verify') }}" class="btn btn-primary px-4 w-100 py-2">
                                <i class="bi bi-arrow-right-circle me-2"></i>
                                Đến Trang Xác Nhận Voucher
                            </a>
                        </div>
                    </div>

                    <!-- Desktop View -->
                    <div class="row g-4 d-none d-md-flex">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body text-center p-4">
                                    <h5 class="card-title text-primary mb-3">
                                        <i class="bi bi-upc-scan me-2"></i>Mã Voucher
                                    </h5>
                                    <div class="voucher-code mb-3">{{ $voucher->code }}</div>
                                    <p class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Hãy cung cấp mã này cho đại lý để đổi quà
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body text-center p-4">
                                    <h5 class="card-title text-primary mb-3">
                                        <i class="bi bi-qr-code me-2"></i>Mã QR
                                    </h5>
                                    <div class="qr-container mb-3 mx-auto">
                                        <img src="data:image/svg+xml;base64,{{ $voucher->qr_code }}" alt="QR Code" class="img-fluid" style="max-width: 150px;">
                                    </div>
                                    <p class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Quét mã QR này sẽ hiển thị mã voucher: <strong>{{ $voucher->code }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="text-center">
                                <a href="{{ route('voucher.verify') }}" class="btn btn-primary px-4">
                                    <i class="bi bi-arrow-right-circle me-2"></i>
                                    Đến Trang Xác Nhận Voucher
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
