@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h4 class="mb-0">Xác Nhận Đổi Quà</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-success text-center mb-4">
                        <i class="bi bi-check-circle-fill fs-1 d-block mb-2"></i>
                        <h5>Voucher hợp lệ</h5>
                        <p class="mb-0">Xác nhận sử dụng voucher này để đổi quà?</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Thông Tin Voucher</h5>
                            <table class="table">
                                <tr>
                                    <th>Mã Voucher:</th>
                                    <td><strong>{{ $voucher->code }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Quà Tặng:</th>
                                    <td>{{ $voucher->gift_name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="{{ $voucher->image_url }}" alt="{{ $voucher->gift_name }}" class="img-fluid rounded" style="max-height: 150px;">
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-danger fw-bold">Lưu ý: Việc đổi quà là không thể hoàn tác.</p>

                        <form action="{{ route('voucher.redeem') }}" method="POST">
                            @csrf
                            <input type="hidden" name="code" value="{{ $voucher->code }}">

                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('voucher.verify') }}" class="btn btn-secondary">
                                    Hủy Bỏ
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Xác Nhận Đổi Quà
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
