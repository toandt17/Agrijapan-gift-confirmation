@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tạo Voucher Mới
                    </h4>
                    <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Quay Lại
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.vouchers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="text-primary mb-0">
                                            <i class="bi bi-info-circle me-2"></i>Thông Tin Cơ Bản
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <label for="gift_name" class="form-label">Tên Quà Tặng <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-gift text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control @error('gift_name') is-invalid @enderror" id="gift_name" name="gift_name" value="{{ old('gift_name') }}" placeholder="Nhập tên quà tặng" required autofocus>
                                            </div>
                                            @error('gift_name')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="alert alert-info">
                                            <i class="bi bi-info-circle-fill me-2"></i>
                                            <small>Mã voucher sẽ được tạo tự động sau khi lưu.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="text-primary mb-0">
                                            <i class="bi bi-image me-2"></i>Hình Ảnh Quà Tặng
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Tải Lên Hình Ảnh <span class="text-danger">*</span></label>
                                            <div id="drop-area" class="image-upload-container text-center p-4 border rounded bg-light mb-3" style="border-style: dashed; transition: all 0.3s;">
                                                <div id="preview-container" class="mb-3 d-none">
                                                    <img id="preview-image" src="#" alt="Preview" class="img-fluid rounded" style="max-height: 200px">
                                                    <div class="mt-2">
                                                        <button type="button" id="remove-image-btn" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-x-circle me-1"></i>Xóa ảnh
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="upload-instruction">
                                                    <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 2.5rem;"></i>
                                                    <p class="fw-bold mt-3 mb-2">Kéo thả hình ảnh vào đây</p>
                                                    <p class="text-muted mb-3">hoặc</p>
                                                    <button type="button" id="browse-btn" class="btn btn-outline-primary mb-3">Chọn file</button>
                                                    <small class="text-muted d-block">Định dạng: JPG, PNG, GIF (Tối đa 2MB)</small>
                                                </div>
                                                <input type="file" class="form-control d-none @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                                            </div>
                                            @error('image')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Tạo Voucher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const dropArea = document.getElementById('drop-area');
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const uploadInstruction = document.querySelector('.upload-instruction');
    const browseBtn = document.getElementById('browse-btn');
    const removeImageBtn = document.getElementById('remove-image-btn');

    // Click to browse
    browseBtn.addEventListener('click', function() {
        imageInput.click();
    });

    // Click to remove image
    removeImageBtn.addEventListener('click', function() {
        // Clear the input file value
        imageInput.value = '';

        // Reset form validation state
        imageInput.required = true;

        // Hide preview and show upload instruction
        previewContainer.classList.add('d-none');
        uploadInstruction.classList.remove('d-none');

        // Clear the preview image src after a small delay
        setTimeout(() => {
            previewImage.src = '#';
        }, 300);
    });

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop area when drag over
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        dropArea.style.borderColor = '#006838';
        dropArea.style.backgroundColor = '#f0f8f4';
    }

    function unhighlight() {
        dropArea.style.borderColor = '';
        dropArea.style.backgroundColor = '';
    }

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length) {
            imageInput.files = files;
            handleFiles(files);
        }
    }

    function handleFiles(files) {
        if (files.length) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                previewFile(file);
            }
        }
    }

    function previewFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('d-none');
            uploadInstruction.classList.add('d-none');
        }
        reader.readAsDataURL(file);
    }

    // Handle file input change
    imageInput.addEventListener('change', function() {
        if (this.files.length) {
            previewFile(this.files[0]);
        } else {
            previewContainer.classList.add('d-none');
            uploadInstruction.classList.remove('d-none');
        }
    });
});
</script>
@endsection
