@extends('layouts.app')

@section('content_title', 'Laporan Penerimaan Barang')

@section('content')
    <style>
        .invoice-card {
            border-radius: 15px !important;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
            overflow: hidden;
        }

        .invoice-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 2rem;
            border-bottom: 2px solid #ebedef;
        }

        .invoice-brand {
            color: #007bff;
            font-weight: 800;
            letter-spacing: -1px;
            font-size: 1.5rem;
        }

        .info-label {
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-value {
            color: #343a40;
            font-weight: 700;
            font-size: 1rem;
        }

        .table-report thead th {
            background-color: #f1f3f5;
            border: none;
            color: #495057;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 12px;
        }

        .table-report tbody td {
            padding: 15px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #f8f9fa;
        }

        .total-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
        }

        @media print {

            .btn,
            .main-footer,
            .main-sidebar,
            .main-header {
                display: none !important;
            }

            .content-wrapper {
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .invoice-card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>

    <div class="container-fluid">
        <div class="row mb-3 no-print">
            <div class="col-12 text-right">
                <button onclick="window.print()" class="btn btn-primary shadow-sm px-4" style="border-radius: 8px;">
                    <i class="fas fa-print mr-2"></i> Cetak Laporan
                </button>
            </div>
        </div>

        <div class="card invoice-card">
            {{-- HEADER --}}
            <div class="invoice-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="invoice-brand mb-1">POS Warung Ziran</div>
                        <span class="badge badge-pill badge-primary-soft text-primary px-3"
                            style="background: rgba(0,123,255,0.1)">
                            LAPORAN PENERIMAAN BARANG
                        </span>
                    </div>
                    <div class="col-md-6 text-md-right mt-3 mt-md-0">
                        <div class="info-label">Tanggal Penerimaan</div>
                        <div class="info-value text-primary"><i class="far fa-calendar-check mr-1"></i>
                            {{ $data->tanggal_penerimaan }}</div>
                    </div>
                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body p-4">
                {{-- INFORMASI --}}
                <div class="row mb-5">
                    <div class="col-sm-4 mb-3">
                        <div class="info-label">Distributor</div>
                        <div class="info-value"><i class="fas fa-truck-loading mr-2 text-muted"></i>{{ $data->distributor }}
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3 border-left">
                        <div class="info-label">Nomor Faktur</div>
                        <div class="info-value"><i
                                class="fas fa-file-invoice mr-2 text-muted"></i>#{{ $data->nomor_faktur }}</div>
                    </div>
                    <div class="col-sm-4 mb-3 border-left">
                        <div class="info-label">Petugas Penerima</div>
                        <div class="info-value"><i
                                class="fas fa-user-check mr-2 text-muted"></i>{{ $data->petugas_penerima }}</div>
                    </div>
                </div>

                {{-- TABEL BARANG --}}
                <div class="table-responsive">
                    <table class="table table-report mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Harga Satuan</th>
                                <th class="text-right">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->items as $index => $item)
                                <tr>
                                    <td class="text-center text-muted">{{ $index + 1 }}</td>
                                    <td><span class="font-weight-bold text-dark">{{ $item->nama_produk }}</span></td>
                                    <td class="text-center"><span class="badge badge-light px-3 py-2"
                                            style="font-size: 0.9rem">{{ number_format($item->qty) }}</span></td>
                                    <td class="text-right text-secondary">Rp {{ number_format($item->harga) }}</td>
                                    <td class="text-right font-weight-bold text-dark">Rp
                                        {{ number_format($item->sub_total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- TOTAL SECTION --}}
                <div class="row mt-4 justify-content-end">
                    <div class="col-md-5 col-lg-4">
                        <div class="total-section d-flex justify-content-between align-items-center">
                            <span class="info-label mb-0">Total Pembelian</span>
                            <h3 class="mb-0 font-weight-bold text-primary" style="letter-spacing: -1px;">
                                Rp {{ number_format($data->total) }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white py-4 border-top-0">
                <div class="row text-center text-muted small">
                    <div class="col-12">
                        Dokumen ini dihasilkan secara otomatis oleh Sistem Manajemen Warung Ziran &bull;
                        {{ date('Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
