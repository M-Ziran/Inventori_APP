@extends('layouts.app')

@section('content_title', 'Dashboard')

@section('content')
    <style>
        /* Sinkronisasi Style dengan Tema Login */
        .content-wrapper {
            background-color: #f8f9fa !important;
        }

        /* Efek Card Modern */
        .card {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        /* Header Tabel & Card */
        .card-header {
            background-color: transparent !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
            padding: 1.25rem !important;
        }

        .card-title {
            font-weight: 700 !important;
            color: #343a40;
            font-size: 1.1rem;
        }

        /* Styling Table */
        .table-modern thead th {
            background-color: #f1f3f5;
            border: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            color: #6c757d;
            padding: 15px;
        }

        .table-modern tbody td {
            padding: 15px;
            vertical-align: middle;
            border-top: 1px solid #f1f3f5;
        }

        /* Customisasi Scrollbar untuk Table Responsive */
        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 10px;
        }

        /* Badge & List Customization */
        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 1rem 1.25rem;
        }

        .list-group-item:first-child {
            border-top: none;
        }
    </style>

    <div class="row">
        <div class="col-lg-3 col-6">
            <x-dashboard-card type="bg-info" icon="fas fa-users" label="Total Users" value="{{ $totalUsers }}" />
        </div>
        <div class="col-lg-3 col-6">
            <x-dashboard-card type="bg-success" icon="fas fa-boxes" label="Total Produk" value="{{ $totalProduk }}" />
        </div>
        <div class="col-lg-3 col-6">
            <x-dashboard-card type="bg-warning" icon="fas fa-shopping-cart" label="Total Order"
                value="{{ $totalOrder }}" />
        </div>
        <div class="col-lg-3 col-6">
            <x-dashboard-card type="bg-primary" icon="fas fa-money-bill-wave" label="Total Pendapatan"
                value="{{ $totalPendapatan }}" />
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-exchange-alt mr-2 text-primary"></i>
                    <h4 class="card-title mb-0">Transaksi Terakhir</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-modern mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nomor Transaksi</th>
                                    <th>Jumlah Item</th>
                                    <th class="text-right">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latesOrder as $item)
                                    <tr>
                                        <td><span class="text-muted"><i class="far fa-calendar-alt mr-1"></i>
                                                {{ $item->tanggal_transaksi }}</span></td>
                                        <td><span class="badge badge-light p-2"
                                                style="font-size: 0.9rem;">#{{ $item->nomor_pengeluaran }}</span></td>
                                        <td><span class="font-weight-bold">{{ $item->items->count() }}</span> <small
                                                class="text-secondary">Item</small></td>
                                        <td class="text-right font-weight-bold text-primary">Rp
                                            {{ number_format($item->total_harga) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> Menampilkan 5 Data Transaksi
                        Terakhir</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-crown mr-2 text-warning"></i>
                    <h4 class="card-title mb-0">Produk Terlaris</h4>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach ($produkTerlaris as $index => $item)
                            <div class="list-group-item d-flex align-items-center border-bottom">
                                <div class="mr-3 text-center" style="width: 30px;">
                                    @if ($index == 0)
                                        <i class="fas fa-medal text-warning" style="font-size: 1.2rem;"></i>
                                    @else
                                        <span class="text-muted font-weight-bold">{{ $index + 1 }}</span>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 font-weight-bold text-dark">{{ $item->nama_produk }}</h6>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-success badge-pill px-3">{{ $item->total_terjual }}
                                        Terjual</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
