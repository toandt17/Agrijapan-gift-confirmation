@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-qr-code-scan me-2"></i>Xác Minh Voucher
                    </h4>
                </div>

                <div class="card-body p-3 p-md-4">
                    @if (session('error'))
                        <div class="alert alert-danger mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill text-danger me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h5 class="alert-heading">Lỗi Xác Minh</h5>
                                    <p class="mb-0">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h5 class="alert-heading">Thành Công</h5>
                                    <p class="mb-0">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Mobile View (Tab-style) -->
                    <div class="d-md-none mb-4">
                        <ul class="nav nav-pills nav-fill mb-4" id="verifyTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="text-tab" data-bs-toggle="tab" data-bs-target="#text-pane" type="button" role="tab" aria-selected="true">
                                    <i class="bi bi-keyboard me-1"></i> Nhập Mã
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="qr-tab" data-bs-toggle="tab" data-bs-target="#qr-pane" type="button" role="tab" aria-selected="false">
                                    <i class="bi bi-qr-code me-1"></i> Quét QR
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="verifyTabContent">
                            <div class="tab-pane fade show active" id="text-pane" role="tabpanel" aria-labelledby="text-tab">
                                <form action="{{ route('voucher.check') }}" method="POST" class="mb-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="mobile-code" class="form-label fw-bold">Mã Voucher</label>
                                        <input type="text" class="form-control form-control-lg text-center @error('code') is-invalid @enderror"
                                            id="mobile-code" name="code" placeholder="Nhập mã voucher"
                                            required autocomplete="off" pattern="[A-Za-z0-9]+"
                                            style="letter-spacing: 1px; font-weight: 500;">
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-2">
                                        <i class="bi bi-search me-2"></i>Kiểm Tra Mã
                                    </button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="qr-pane" role="tabpanel" aria-labelledby="qr-tab">
                                <div class="text-center">
                                    <div id="reader-mobile" class="mx-auto mb-3" style="width: 100%; max-width: 300px; height: 200px;"></div>
                                    <button id="start-mobile-scanner" class="btn btn-primary mb-3">
                                        <i class="bi bi-camera me-2"></i>Mở Máy Ảnh
                                    </button>
                                    <p class="text-muted small">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Quét mã QR trên voucher để xác minh nhanh
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 px-2 py-3 bg-light rounded-3">
                            <div class="text-center text-primary mb-2">
                                <i class="bi bi-lightbulb me-1"></i>
                                <span class="fw-medium">Hướng Dẫn</span>
                            </div>
                            <ul class="mb-0 ps-3 small">
                                <li class="mb-1">Nhập mã voucher hoặc quét mã QR để xác minh</li>
                                <li>Chỉ các mã hợp lệ và chưa sử dụng mới đổi được quà</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Desktop View (Side-by-side) -->
                    <div class="row g-4 d-none d-md-flex">
                        <div class="col-md-6">
                            <div class="card h-100 border">
                                <div class="card-body p-4">
                                    <h5 class="card-title text-primary mb-4 text-center">
                                        <i class="bi bi-keyboard me-2"></i>Nhập Mã Voucher
                                    </h5>
                                    <form action="{{ route('voucher.check') }}" method="POST" class="mb-3">
                                        @csrf
                                        <div class="mb-4">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-ticket-detailed text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control form-control-lg @error('code') is-invalid @enderror"
                                                    name="code" placeholder="Nhập mã voucher" required autocomplete="off"
                                                    pattern="[A-Za-z0-9]+" style="letter-spacing: 1px; font-weight: 500;">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-search me-1"></i> Kiểm Tra
                                                </button>
                                            </div>
                                            @error('code')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </form>
                                    <div class="text-center text-muted">
                                        <small>Nhập mã voucher để kiểm tra tính hợp lệ</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 border">
                                <div class="card-body p-4">
                                    <h5 class="card-title text-primary mb-4 text-center">
                                        <i class="bi bi-qr-code me-2"></i>Quét Mã QR
                                    </h5>
                                    <div class="text-center">
                                        <div id="reader-desktop" class="mb-4 mx-auto" style="width: 100%; max-width: 300px; height: 200px;"></div>
                                        <button id="start-desktop-scanner" class="btn btn-primary mb-3">
                                            <i class="bi bi-camera me-2"></i>Mở Máy Ảnh
                                        </button>
                                        <p class="text-muted">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Quét mã QR trên voucher để kiểm tra nhanh
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-none d-md-block">
                        <div class="card bg-light border-0">
                            <div class="card-body p-3">
                                <h5 class="text-primary mb-2">
                                    <i class="bi bi-lightbulb me-2"></i>Hướng Dẫn
                                </h5>
                                <ul class="mb-0">
                                    <li class="mb-2">Nhập mã voucher hoặc quét mã QR để xem thông tin quà tặng</li>
                                    <li class="mb-2">Chỉ các mã voucher hợp lệ và chưa được sử dụng mới có thể đổi quà</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thêm thư viện HTML5-QRCode -->
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Autoselect text input when focused
    const codeInputs = document.querySelectorAll('input[name="code"]');
    codeInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.select();
        });
    });

    // Khởi tạo QR Scanner
    const config = {
        fps: 10,
        qrbox: { width: 250, height: 250 },
        aspectRatio: 1.0
    };

    let mobileScanner = null;
    let desktopScanner = null;

    // Xử lý khi quét được mã
    function onScanSuccess(decodedText) {
        console.log(`Đã quét được mã: ${decodedText}`);
        // Nếu đã quét được mã thì chuyển hướng đến trang xác minh
        window.location.href = "{{ route('voucher.verify') }}/" + decodedText;
    }

    // Khởi tạo scanner cho mobile
    document.getElementById('start-mobile-scanner').addEventListener('click', function() {
        if (mobileScanner) {
            mobileScanner.clear();
        }

        mobileScanner = new Html5Qrcode("reader-mobile");
        mobileScanner.start(
            { facingMode: "environment" }, // Sử dụng camera sau
            config,
            onScanSuccess
        ).catch(err => {
            console.error("Không thể khởi động camera: ", err);
            alert("Không thể mở máy ảnh. Vui lòng kiểm tra quyền truy cập camera trong trình duyệt của bạn.");
        });

        this.innerHTML = '<i class="bi bi-x-circle me-2"></i>Tắt Máy Ảnh';
        this.classList.replace('btn-primary', 'btn-danger');

        // Đổi event listener để tắt camera khi bấm lại
        this.removeEventListener('click', arguments.callee);
        this.addEventListener('click', function() {
            if (mobileScanner) {
                mobileScanner.stop().then(() => {
                    this.innerHTML = '<i class="bi bi-camera me-2"></i>Mở Máy Ảnh';
                    this.classList.replace('btn-danger', 'btn-primary');

                    // Đổi lại event listener để mở camera khi bấm
                    this.removeEventListener('click', arguments.callee);
                    document.getElementById('start-mobile-scanner').addEventListener('click', arguments.callee.caller);
                });
            }
        });
    });

    // Khởi tạo scanner cho desktop
    document.getElementById('start-desktop-scanner').addEventListener('click', function() {
        if (desktopScanner) {
            desktopScanner.clear();
        }

        desktopScanner = new Html5Qrcode("reader-desktop");
        desktopScanner.start(
            { facingMode: "environment" }, // Sử dụng camera sau
            config,
            onScanSuccess
        ).catch(err => {
            console.error("Không thể khởi động camera: ", err);
            alert("Không thể mở máy ảnh. Vui lòng kiểm tra quyền truy cập camera trong trình duyệt của bạn.");
        });

        this.innerHTML = '<i class="bi bi-x-circle me-2"></i>Tắt Máy Ảnh';
        this.classList.replace('btn-primary', 'btn-danger');

        // Đổi event listener để tắt camera khi bấm lại
        this.removeEventListener('click', arguments.callee);
        this.addEventListener('click', function() {
            if (desktopScanner) {
                desktopScanner.stop().then(() => {
                    this.innerHTML = '<i class="bi bi-camera me-2"></i>Mở Máy Ảnh';
                    this.classList.replace('btn-danger', 'btn-primary');

                    // Đổi lại event listener để mở camera khi bấm
                    this.removeEventListener('click', arguments.callee);
                    document.getElementById('start-desktop-scanner').addEventListener('click', arguments.callee.caller);
                });
            }
        });
    });
});
</script>
@endsection
