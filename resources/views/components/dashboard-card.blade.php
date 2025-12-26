<div class="col-lg-3 col-6">
    <style>
        /* Styling khusus untuk Small Box Modern */
        .small-box-modern {
            position: relative;
            display: block;
            border-radius: 16px !important;
            overflow: hidden;
            padding: 20px;
            margin-bottom: 20px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            background-color: #fff;
            /* Fallback */
            z-index: 1;
        }

        .small-box-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .small-box-modern .inner {
            position: relative;
            z-index: 3;
        }

        .small-box-modern h3 {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0 0 5px 0;
            white-space: nowrap;
            padding: 0;
            z-index: 3;
            letter-spacing: -1px;
        }

        .small-box-modern p {
            font-size: 0.9rem;
            font-weight: 600;
            opacity: 0.8;
            margin-bottom: 0;
        }

        /* Styling Ikon Besar di Belakang */
        .small-box-modern .icon-wrapper {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 50px;
            opacity: 0.15;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .small-box-modern:hover .icon-wrapper {
            font-size: 60px;
            opacity: 0.25;
            transform: translateY(-55%) rotate(-10deg);
        }

        /* Modifikasi warna AdminLTE menjadi Gradient Soft */
        .bg-modern-info {
            background: linear-gradient(135deg, #17a2b8, #31d2f2);
            color: #fff;
        }

        .bg-modern-success {
            background: linear-gradient(135deg, #28a745, #48d667);
            color: #fff;
        }

        .bg-modern-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb70);
            color: #1f2d3d;
        }

        .bg-modern-primary {
            background: linear-gradient(135deg, #007bff, #3395ff);
            color: #fff;
        }

        .bg-modern-danger {
            background: linear-gradient(135deg, #dc3545, #ff6b6b);
            color: #fff;
        }
    </style>

    @php
        // Map warna original AdminLTE ke class gradient modern kita
        $modernClass = str_replace('bg-', 'bg-modern-', $type);
    @endphp

    <div class="small-box-modern {{ $modernClass }}">
        <div class="inner">
            <h3>{{ $value }}</h3>
            <p>{{ $label }}</p>
        </div>
        <div class="icon-wrapper">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
</div>
