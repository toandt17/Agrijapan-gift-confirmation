<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Quà Tặng {{ $voucher->code }} - Agrijapan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #006838;
            --primary-dark: #00522c;
            --accent-color: #ED1C24;
            --light-color: #ffffff;
            --border-color: #ddd;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f0f0;
            color: #333;
            padding: 0;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: radial-gradient(#e6e6e6 2px, transparent 2px);
            background-size: 30px 30px;
        }

        .container {
            padding: 20px;
            max-width: 480px;
        }

        .voucher-wrapper {
            position: relative;
            margin: 0 auto;
            max-width: 450px;
            filter: drop-shadow(0 15px 20px rgba(0,0,0,0.15));
        }

        .voucher-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .voucher-header {
            background-color: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .voucher-body {
            padding: 20px;
            position: relative;
            z-index: 1;
            background-image:
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 0,0 L 100,0 L 100,100 L 0,100 Z' fill='none' stroke='%23006838' stroke-width='0.3' stroke-opacity='0.05'/%3E%3C/svg%3E");
        }

        .voucher-footer {
            background-color: #f8f9fa;
            padding: 12px 15px;
            font-size: 0.85rem;
            position: relative;
            z-index: 1;
        }

        .gift-image-container {
            position: relative;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .gift-image {
            width: 100%;
            height: 320px;
            object-fit: cover;
            display: block;
        }

        .gift-name-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(0deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
            padding: 30px 15px 15px;
            color: white;
            text-align: left;
        }

        .gift-name {
            font-size: 1.4rem;
            font-weight: 700;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
            margin-bottom: 0;
        }

        .qr-container {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: white;
            padding: 5px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            border: 2px solid white;
            z-index: 5;
        }

        .logo {
            height: 35px;
            width: auto;
            margin-bottom: 5px;
            filter: drop-shadow(0 2px 3px rgba(0,0,0,0.1));
        }

        .serial-number {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.7rem;
            color: rgba(255,255,255,0.7);
            letter-spacing: 0.05em;
        }

        .btn-check {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
            width: 100%;
        }

        .btn-check:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 5rem;
            font-weight: 800;
            opacity: 0.03;
            color: var(--primary-color);
            pointer-events: none;
            white-space: nowrap;
            z-index: 0;
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .gift-name {
                font-size: 1.2rem;
            }

            .gift-image {
                height: 280px;
            }

            .qr-container img {
                width: 70px;
                height: 70px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="voucher-wrapper">
            <div class="voucher-card">
                <div class="voucher-header">
                    <h1 class="fs-5 mb-0">VOUCHER QUÀ TẶNG</h1>
                </div>

                <div class="voucher-body">
                    <div class="watermark">AGRIJAPAN</div>

                    <div class="gift-image-container">
                        <img src="{{ $voucher->image_url }}" alt="{{ $voucher->gift_name }}" class="gift-image">
                        <div class="gift-name-overlay">
                            <div class="gift-name">{{ $voucher->gift_name }}</div>
                        </div>
                        <div class="qr-container">
                            <img src="data:image/svg+xml;base64,{{ $voucher->qr_code }}" alt="QR Code" style="width: 80px; height: 80px;">
                        </div>
                    </div>

                    <a href="{{ route('voucher.verify') }}" class="btn-check">
                        <i class="bi bi-check-circle me-1"></i>Kiểm tra voucher
                    </a>
                </div>

                <div class="voucher-footer">
                    <div class="row align-items-center">
                        <div class="col">
                            <small class="text-muted">© {{ date('Y') }} Agrijapan</small>
                        </div>
                        <div class="col-auto">
                            <small class="text-muted">Ngày tạo: {{ $voucher->created_at->format('d/m/Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
