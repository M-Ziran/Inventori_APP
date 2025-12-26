@extends('layouts.app')

@section('content_title', 'Data Kategori')

@section('content')
    <style>
        /* Card Container Utama */
        .category-card {
            border-radius: 20px !important;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03) !important;
            overflow: hidden;
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
            font-size: 0.75rem;
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

        /* Icon Category Badge */
        .category-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f0f7ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #007bff;
            font-size: 1.1rem;
        }

        /* Action Wrapper Style */
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
            letter-spacing: 0.8px;
            text-decoration: none !important;
        }

        .link-delete:hover {
            opacity: 0.7;
        }
    </style>

    <div class="card category-card">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-0">
            <div>
                <h4 class="m-0 font-weight-bold text-dark">Data Kategori</h4>
                <p class="text-muted small m-0">Pengelompokan produk untuk mempermudah inventori</p>
            </div>
            <div>
                <x-kategori.form-kategori />
            </div>
        </div>

        <div class="card-body px-4 pt-0">
            <x-alert :errors="$errors" />

            <div class="table-responsive">
                <table class="table table-modern" id="table-kategori-modern">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Info Kategori</th>
                            <th>Deskripsi</th>
                            <th width="180px" class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $index => $item)
                            <tr>
                                <td class="text-muted font-weight-bold text-center">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="category-icon mr-3">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark">{{ $item->nama_kategori }}</div>
                                            <div class="text-muted small">ID:
                                                CAT-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="max-width: 300px;" class="text-truncate text-muted small">
                                        {{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="action-wrapper">
                                        <div class="small">
                                            <x-kategori.form-kategori :id="$item->id" :nama_kategori="$item->nama_kategori" :deskripsi="$item->deskripsi"
                                                label="Edit" />
                                        </div>

                                        <div class="divider-dot"></div>

                                        <a href="{{ route('master-data.kategori.destroy', $item->id) }}" class="link-delete"
                                            data-confirm-delete="true">
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
            $('#table-kategori-modern').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 6,
                /* Menyesuaikan agar tetap no-scroll */
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari kategori...",
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });

            // Mempercantik kotak pencarian
            $('.dataTables_filter input').addClass('form-control-sm border-0 shadow-sm px-3').css({
                'border-radius': '20px',
                'background': '#f1f4f8',
                'width': '220px'
            });
        });
    </script>
@endpush
