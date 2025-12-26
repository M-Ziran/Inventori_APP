@extends('layouts.app')

@section('content_title', 'Data Produk')

@section('content')
    <style>
        /* Card Container Utama */
        .product-card {
            border-radius: 20px !important;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03) !important;
            overflow: hidden;
            background: #fff;
        }

        /* Header Styling */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px;
            background: #fff;
            border-bottom: 1px solid #f8f9fa;
        }

        /* Styling Tabel Modern (Floating Row) */
        .table-modern {
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: -10px;
        }

        .table-modern thead th {
            border: none;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 1px;
            color: #95aac9;
            padding: 15px 25px;
        }

        .table-modern tbody tr {
            background-color: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .table-modern tbody tr:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
            background-color: #fcfdff;
        }

        .table-modern td {
            padding: 15px 25px !important;
            vertical-align: middle !important;
            border-top: 1px solid #f1f4f8 !important;
            border-bottom: 1px solid #f1f4f8 !important;
        }

        /* Rounding Corner untuk Baris */
        .table-modern td:first-child {
            border-left: 1px solid #f1f4f8 !important;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .table-modern td:last-child {
            border-right: 1px solid #f1f4f8 !important;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* Badge Custom */
        .sku-badge {
            background: #f1f4f8;
            color: #495057;
            padding: 4px 8px;
            border-radius: 6px;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .price-text {
            font-weight: 800;
            color: #2c7be5;
        }

        .stock-indicator {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.75rem;
        }

        /* Action Wrapper */
        .action-wrapper {
            background: #f8f9fa;
            padding: 5px 12px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            border: 1px solid #edf2f9;
        }

        .divider-dot {
            width: 4px;
            height: 4px;
            background: #d2ddec;
            border-radius: 50%;
            margin: 0 8px;
        }

        .link-delete {
            color: #e63757;
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            text-decoration: none !important;
        }
    </style>

    <div class="card product-card">
        <div class="header-container">
            <div>
                <h4 class="m-0 font-weight-bold text-dark">Daftar Produk</h4>
                <p class="text-muted small m-0">Kelola stok dan harga barang Warung Ziran</p>
            </div>
            <div>
                <x-product.form-product />
            </div>
        </div>

        <div class="card-body px-4 pt-0">
            <x-alert :errors="$errors" type="warning" />

            <div class="table-responsive">
                <table class="table table-modern" id="table-produk-modern">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Info Produk</th>
                            <th class="text-right">Harga (Jual/Beli)</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Status</th>
                            <th width="150px" class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr>
                                <td class="text-center text-muted font-weight-bold small">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold text-dark">{{ $product->nama_produk }}</span>
                                        <span class="sku-badge mt-1" style="width: fit-content;">{{ $product->sku }}</span>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="price-text">Rp {{ number_format($product->harga_jual) }}</div>
                                    <div class="text-muted small">Beli: Rp {{ number_format($product->harga_beli_pokok) }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php $isLow = $product->stok <= 5; @endphp
                                    <span
                                        class="stock-indicator {{ $isLow ? 'bg-soft-danger text-danger' : 'bg-soft-success text-success' }}"
                                        style="background-color: {{ $isLow ? '#fee2e2' : '#dcfce7' }}">
                                        {{ number_format($product->stok) }} Item
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge badge-pill {{ $product->is_active ? 'badge-success' : 'badge-danger' }}"
                                        style="font-size: 0.7rem; padding: 5px 12px;">
                                        {{ $product->is_active ? 'AKTIF' : 'NON-AKTIF' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="action-wrapper">
                                        <div class="small">
                                            <x-product.form-product :id="$product->id" label="Edit" />
                                        </div>
                                        <div class="divider-dot"></div>
                                        <a href="{{ route('master-data.product.destroy', $product->id) }}"
                                            class="link-delete" data-confirm-delete="true">
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            // ID t2 sudah tidak digunakan, diganti ID spesifik halaman
            $('#table-produk-modern').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 5,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari produk...",
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });

            // Searchbox Custom agar lebih premium
            $('.dataTables_filter input').addClass('form-control border-0 shadow-sm px-3').css({
                'border-radius': '20px',
                'background': '#f1f4f8',
                'width': '250px'
            });
        });
    </script>
@endpush
