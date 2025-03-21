@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h4 class="mb-0">Đổi Quà Thành Công</h4>
                </div>

                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                    </div>

                    <h4 class="text-success mb-3">Voucher đã được sử dụng thành công!</h4>

                    <div class="alert alert-info mb-4">
                        <p class="mb-0">Quà tặng <strong>{{ $voucher->gift_name }}</strong> đã được đổi thành công.</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Thông Tin Voucher</h5>
                                    <table class="table">
                                        <tr>
                                            <th>Mã Voucher:</th>
                                            <td><strong>{{ $voucher->code }}</strong></td>
                                        </tr>
                                        <tr>
                                            <th>Quà Tặng:</th>
                                            <td>{{ $voucher->gift_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Trạng Thái:</th>
                                            <td><span class="badge bg-danger">Đã Sử Dụng</span></td>
                                        </tr>
                                        <tr>
                                            <th>Thời Gian Đổi:</th>
                                            <td>{{ $voucher->redemption ? $voucher->redemption->redeemed_at->format('d/m/Y H:i:s') : now()->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('voucher.verify') }}" class="btn btn-primary">
                            Quay Lại Trang Xác Nhận
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
