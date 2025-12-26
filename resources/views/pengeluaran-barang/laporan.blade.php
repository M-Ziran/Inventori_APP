@extends('layouts.app')

@section('content_title', 'Laporan Pengeluaran Barang')

@section('content')
    <style>
        .card-report {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .table-modern thead th {
            background-color: #f8f9fa;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            font-weight: 700;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }

        .text-nominal {
            font-family: 'Monaco', 'Consolas', monospace;
            font-weight: 600;
        }

        .badge-id {
            background-color: #eef2f7;
            color: #334155;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .btn-detail {
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-detail:hover {
            transform: scale(1.05);
        }
    </style>

    <div class="card card-report">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-history mr-2 text-primary"></i> Riwayat Transaksi Penjualan
                </h5>
                <div class="text-muted small">
                    Total Transaksi: <strong>{{ count($data) }}</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-modern" id="t2">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>ID Transaksi</th>
                            <th>Waktu</th>
                            <th class="text-right">Total</th>
                            <th class="text-right">Bayar</th>
                            <th class="text-right">Kembali</th>
                            <th>Kasir</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge-id">{{ $item->nomor_pengeluaran }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="far fa-clock mr-1"></i> {{ $item->tanggal_transaksi }}
                                    </small>
                                </td>
                                <td class="text-right text-nominal text-dark">
                                    {{ number_format($item->total_harga) }}
                                </td>
                                <td class="text-right text-nominal text-success">
                                    {{ number_format($item->bayar) }}
                                </td>
                                <td class="text-right text-nominal text-danger">
                                    {{ number_format($item->kembalian) }}
                                </td>
                                <td>
                                    <span class="badge badge-light border">
                                        <i class="fas fa-user-circle mr-1 text-secondary"></i>
                                        {{ ucwords($item->nama_petugas) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('laporan.pengeluaran-barang.detail-laporan', $item->nomor_pengeluaran) }}"
                                        class="btn btn-sm btn-primary btn-detail px-3 shadow-sm">
                                        <i class="fas fa-file-invoice mr-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
