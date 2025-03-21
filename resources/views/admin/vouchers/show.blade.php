@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="text-primary mb-0">
                        <i class="bi bi-ticket-perforated-fill me-2"></i>Chi Tiết Voucher
                    </h4>
                    <a href="{{ route('admin.vouchers.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Quay Lại
                    </a>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="mb-3">{{ $voucher->gift_name }}</h3>
                        <img src="{{ $voucher->image_url }}" alt="{{ $voucher->gift_name }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0 text-primary">
                                        <i class="bi bi-info-circle me-2"></i>Thông Tin Voucher
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th style="width: 40%;">Mã Voucher:</th>
                                            <td><span class="fw-bold text-primary">{{ $voucher->code }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Ngày tạo:</th>
                                            <td>{{ $voucher->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Trạng thái:</th>
                                            <td>
                                                @if ($voucher->is_redeemed)
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-x-circle me-1"></i>Đã Sử Dụng
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>Chưa Sử Dụng
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($voucher->is_redeemed && $voucher->redemption)
                                        <tr>
                                            <th>Ngày sử dụng:</th>
                                            <td>{{ $voucher->redemption->redeemed_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0 text-primary">
                                        <i class="bi bi-qr-code me-2"></i>Mã QR
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="qr-container p-2 d-inline-block border rounded mb-2">
                                        <img src="data:image/svg+xml;base64,{{ $voucher->qr_code }}" alt="QR Code" class="img-fluid" style="width: 150px;">
                                    </div>
                                    <p class="text-muted small mb-0">
                                        Quét mã QR này sẽ hiển thị mã voucher: <strong>{{ $voucher->code }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0 text-primary">
                                        <i class="bi bi-share me-2"></i>Link Chia Sẻ
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-2">Link dưới đây có thể được chia sẻ cho người dùng để họ xem thông tin voucher và mã QR:</p>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control share-link" readonly
                                            value="{{ route('voucher.share', $voucher->code) }}" id="detail-share-link">
                                        <button class="btn btn-outline-primary copy-btn" type="button"
                                            data-clipboard-target="#detail-share-link">
                                            <i class="bi bi-clipboard me-1"></i>Sao chép
                                        </button>
                                        <a href="{{ route('voucher.share', $voucher->code) }}" target="_blank"
                                            class="btn btn-outline-secondary" title="Mở link">
                                            <i class="bi bi-box-arrow-up-right me-1"></i>Mở
                                        </a>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Link này hiển thị thông tin voucher, QR code và có thể chia sẻ công khai.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-between">
                            <div>
                                <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil me-1"></i>Chỉnh Sửa
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteVoucherModal">
                                    <i class="bi bi-trash me-1"></i>Xóa
                                </button>
                            </div>
                            <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Quay Lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Xác nhận xóa -->
<div class="modal fade" id="deleteVoucherModal" tabindex="-1" aria-labelledby="deleteVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteVoucherModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                </div>
                <p>Bạn có chắc chắn muốn xóa voucher <strong>{{ $voucher->code }}</strong>?</p>
                <p class="text-danger"><small>Lưu ý: Hành động này không thể hoàn tác!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa voucher</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toast thông báo sao chép -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="copyToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle-fill me-2"></i> Đã sao chép link vào clipboard!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo clipboard.js
    var clipboard = new ClipboardJS('.copy-btn');
    var copyToast = new bootstrap.Toast(document.getElementById('copyToast'));

    clipboard.on('success', function(e) {
        copyToast.show();
        e.clearSelection();
    });
});
</script>
@endsection
