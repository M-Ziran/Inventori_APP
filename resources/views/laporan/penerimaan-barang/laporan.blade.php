@extends('layouts.app')

@section('content_title', 'Laporan Penerimaan Barang')

@section('content')
    <style>
        /* Styling khusus tabel laporan */
        .table-modern thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
            border-bottom: 2px solid #dee2e6;
        }

        .badge-faktur {
            background-color: #e9ecef;
            color: #495057;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 6px;
            font-family: 'Courier New', Courier, monospace;
        }

        .btn-detail {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
            padding: 6px 15px;
        }

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
        }
    </style>

    <div class="card shadow-sm" style="border-radius: 15px; border: none;">
        <div class="card-header bg-white py-3">
            <div class="d-flex align-items-center">
                <div class="bg-primary-soft mr-3 d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px; border-radius: 10px; background: rgba(0,123,255,0.1);">
                    <i class="fas fa-clipboard-list text-primary"></i>
                </div>
                <h5 class="card-title m-0 font-weight-bold">Riwayat Penerimaan Barang</h5>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-modern" id="t2">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nomor Penerimaan</th>
                            <th>Nomor Faktur</th>
                            <th>Distributor</th>
                            <th>Tanggal Masuk</th>
                            <th>Petugas</th>
                            <th width="10%" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerimaanBarang as $index => $item)
                            <tr>
                                <td class="text-center text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <span class="font-weight-bold text-dark">{{ $item->nomor_penerimaan }}</span>
                                </td>
                                <td>
                                    <span class="badge-faktur">#{{ $item->nomor_faktur }}</span>
                                </td>
                                <td>
                                    <i class="fas fa-truck text-muted mr-1 small"></i> {{ $item->distributor }}
                                </td>
                                <td>
                                    <span class="text-secondary small">
                                        <i class="far fa-calendar-alt mr-1"></i> {{ $item->tanggal_penerimaan }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-light p-2" style="font-weight: 500;">
                                        <i class="far fa-user mr-1 text-primary"></i> {{ $item->petugas_penerima }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('laporan.penerimaan-barang.detail-laporan', $item->nomor_penerimaan) }}"
                                        class="btn btn-sm btn-primary btn-detail">
                                        <i class="fas fa-eye mr-1"></i> Detail
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
