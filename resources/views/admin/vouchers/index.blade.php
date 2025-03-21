@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-primary">
                        <i class="bi bi-ticket-perforated-fill me-2"></i>Quản lý Voucher
                    </h4>
                    <button type="button" onclick="window.location='{{ route('admin.vouchers.create') }}'" class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-plus-circle me-2"></i> Tạo Voucher Mới
                    </button>
                </div>

                <div class="card-body">
                    <!-- Bộ lọc voucher -->
                    <div class="filter-section mb-4">
                        <form action="{{ route('admin.vouchers.index') }}" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="Tìm mã voucher..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-select">
                                    <option value="">-- Trạng thái --</option>
                                    <option value="unredeemed" {{ request('status') == 'unredeemed' ? 'selected' : '' }}>Chưa sử dụng</option>
                                    <option value="redeemed" {{ request('status') == 'redeemed' ? 'selected' : '' }}>Đã sử dụng</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
                                    <input type="date" name="date_from" class="form-control" placeholder="Từ ngày" value="{{ request('date_from') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
                                    <input type="date" name="date_to" class="form-control" placeholder="Đến ngày" value="{{ request('date_to') }}">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel-fill"></i></button>
                            </div>
                            @if(request('search') || request('status') || request('date_from') || request('date_to'))
                            <div class="col-auto">
                                <a href="{{ route('admin.vouchers.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>Xóa bộ lọc
                                </a>
                            </div>
                            @endif
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã</th>
                                    <th>Tên Quà Tặng</th>
                                    <th>Hình Ảnh</th>
                                    <th>QR Code</th>
                                    <th>Link Chia Sẻ</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày Tạo</th>
                                    <th class="text-center">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vouchers as $voucher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="fw-bold text-primary">{{ $voucher->code }}</span>
                                    </td>
                                    <td>{{ $voucher->gift_name }}</td>
                                    <td class="text-center">
                                        <img src="{{ $voucher->image_url }}" alt="{{ $voucher->gift_name }}" class="img-thumbnail" style="max-height: 50px;">
                                    </td>
                                    <td class="text-center">
                                        <div style="max-height: 50px; max-width: 50px; margin: 0 auto;">
                                            <img src="data:image/svg+xml;base64,{{ $voucher->qr_code }}" alt="QR Code" class="img-thumbnail" title="Mã QR chứa: {{ $voucher->code }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm share-link" readonly
                                                value="{{ route('voucher.share', $voucher->code) }}" id="share-link-{{ $voucher->id }}">
                                            <button class="btn btn-sm btn-outline-primary copy-btn" type="button"
                                                data-clipboard-target="#share-link-{{ $voucher->id }}" title="Sao chép link">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                            <a href="{{ route('voucher.share', $voucher->code) }}" target="_blank"
                                                class="btn btn-sm btn-outline-secondary" title="Mở link">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-center">
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
                                    <td>{{ $voucher->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" onclick="window.location='{{ route('admin.vouchers.show', $voucher->id) }}'"
                                                class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Chi tiết">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                            <button type="button" onclick="window.location='{{ route('admin.vouchers.edit', $voucher->id) }}'"
                                                class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Chỉnh sửa">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip"
                                                title="Xóa" onclick="confirmDelete({{ $voucher->id }}, '{{ $voucher->code }}')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                            <form id="delete-form-{{ $voucher->id }}" action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox-fill" style="font-size: 2rem;"></i>
                                            <p class="mt-2">Không có dữ liệu voucher</p>
                                            <button type="button" onclick="window.location='{{ route('admin.vouchers.create') }}'" class="btn btn-primary mt-2">
                                                <i class="bi bi-plus-circle me-1"></i> Tạo Voucher Mới
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $vouchers->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Xác nhận xóa -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                </div>
                <p>Bạn có chắc chắn muốn xóa voucher <strong id="delete-voucher-code"></strong>?</p>
                <p class="text-danger"><small>Lưu ý: Hành động này không thể hoàn tác!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Xóa voucher</button>
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
document.addEventListener('DOMContentLoaded', function () {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Xử lý xác nhận xóa
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    var voucherId = null;

    window.confirmDelete = function(id, code) {
        voucherId = id;
        document.getElementById('delete-voucher-code').textContent = code;
        deleteModal.show();
    }

    document.getElementById('confirm-delete').addEventListener('click', function() {
        if (voucherId) {
            document.getElementById('delete-form-' + voucherId).submit();
        }
        deleteModal.hide();
    });

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
