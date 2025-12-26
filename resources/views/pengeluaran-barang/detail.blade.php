@extends('layouts.app')

@section('content_title', 'Laporan Pengeluaran Barang')

@section('content')
    <style>
        .receipt-card {
            border-radius: 20px !important;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
        }

        .receipt-header {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 20px 20px 0 0 !important;
            border-bottom: 2px dashed #dee2e6;
            position: relative;
        }

        /* Efek lubang kertas di samping */
        .receipt-header::after,
        .receipt-header::before {
            content: '';
            position: absolute;
            bottom: -10px;
            width: 20px;
            height: 20px;
            background: #f4f6f9;
            /* Sesuaikan warna background wrapper adminLTE */
            border-radius: 50%;
        }

        .receipt-header::before {
            left: -10px;
        }

        .receipt-header::after {
            right: -10px;
        }

        .status-badge {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            font-weight: 700;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.75rem;
        }

        .data-label {
            color: #6c757d;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0;
        }

        .data-value {
            color: #343a40;
            font-weight: 700;
        }

        .payment-info {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
        }

        .table-receipt thead th {
            border-top: none;
            border-bottom: 2px solid #f1f3f5;
            text-transform: uppercase;
            font-size: 0.75rem;
            color: #6c757d;
        }

        .table-receipt td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
        }
    </style>

    <div class="container">
        <div class="row mb-3 no-print">
            <div class="col-12 text-right">
                <button onclick="window.print()" class="btn btn-dark shadow-sm px-4" style="border-radius: 10px;">
                    <i class="fas fa-print mr-2"></i> Print Struk
                </button>
            </div>
        </div>

        <div class="card receipt-card">
            {{-- HEADER --}}
            <div class="receipt-header">
                <div class="row">
                    <div class="col-md-6">
                        <div class="status-badge mb-2 d-inline-block">TRANSAKSI SELESAI</div>
                        <h3 class="font-weight-bold mb-0">#{{ $data->nomor_pengeluaran }}</h3>
                        <p class="text-muted small mb-0"><i class="far fa-clock mr-1"></i> {{ $data->tanggal_transaksi }}
                        </p>
                    </div>
                    <div class="col-md-6 text-md-right mt-3 mt-md-0">
                        <h4 class="font-weight-bold text-primary mb-0">Warung Ziran</h4>
                        <small class="text-muted">Kasir: {{ $data->nama_petugas }}</small>
                    </div>
                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body p-4">
                {{-- TABEL ITEM --}}
                <div class="table-responsive">
                    <table class="table table-receipt">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->items as $index => $item)
                                <tr>
                                    <td class="text-muted">{{ $index + 1 }}</td>
                                    <td class="font-weight-600 text-dark">{{ $item->nama_produk }}</td>
                                    <td class="text-center"><span
                                            class="badge badge-light px-3 py-2">{{ number_format($item->qty) }}</span></td>
                                    <td class="text-right">Rp {{ number_format($item->harga) }}</td>
                                    <td class="text-right font-weight-bold">Rp {{ number_format($item->sub_total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr class="my-4" style="border-top: 2px solid #f8f9fa;">

                {{-- PAYMENT SUMMARY --}}
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <div class="payment-info">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="data-label">Total Harga</span>
                                <span class="data-value">Rp {{ number_format($data->total_harga) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="data-label">Dibayar</span>
                                <span class="data-value text-success">Rp {{ number_format($data->bayar) }}</span>
                            </div>
                            <div class="d-flex justify-content-between pt-3 border-top">
                                <span class="font-weight-bold text-dark">Kembalian</span>
                                <h4 class="font-weight-bold text-primary mb-0">Rp {{ number_format($data->kembalian) }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white border-top-0 pb-5 text-center">
                <p class="text-muted small">Terima kasih telah berbelanja di Warung Ziran!</p>
                <div class="d-flex justify-content-center">
                    <div style="width: 100px; height: 4px; background: #eee; border-radius: 10px;"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            .main-footer,
            .main-sidebar,
            .main-header {
                display: none !important;
            }

            .content-wrapper {
                background: white !important;
                margin: 0 !important;
            }

            .receipt-card {
                box-shadow: none !important;
            }

            .receipt-header::after,
            .receipt-header::before {
                display: none;
            }
        }
    </style>
@endsection
