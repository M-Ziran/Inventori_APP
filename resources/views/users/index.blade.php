@extends('layouts.app')

@section('content_title', 'Data Users')

@section('content')
    <style>
        /* Card Container Utama */
        .user-card {
            border-radius: 20px !important;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03) !important;
            overflow: hidden;
        }

        /* Styling Tabel Modern */
        .table-modern {
            border-collapse: separate;
            border-spacing: 0 10px;
            /* Memberi jarak antar baris */
            margin-top: -10px;
        }

        .table-modern thead th {
            border: none;
            background-color: transparent;
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

        /* User Avatar */
        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            /* Square rounded lebih modern dari circle */
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(110, 142, 251, 0.3);
        }

        /* Action Buttons Wrapper */
        .action-wrapper {
            background: #f8f9fa;
            padding: 5px 15px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            border: 1px solid #edf2f9;
        }

        .action-link {
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            text-decoration: none !important;
            padding: 4px 10px;
            transition: 0.2s;
        }

        .link-edit {
            color: #2c7be5;
        }

        .link-reset {
            color: #6e84a3;
        }

        .link-delete {
            color: #e63757;
        }

        .action-link:hover {
            opacity: 0.7;
        }

        .divider-dot {
            width: 4px;
            height: 4px;
            background: #d2ddec;
            border-radius: 50%;
            margin: 0 5px;
        }

        /* Badge Email */
        .badge-email {
            background: #e9f2ff;
            color: #2c7be5;
            padding: 5px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
        }
    </style>

    <div class="card user-card">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-0">
            <div>
                <h4 class="m-0 font-weight-bold text-dark">Manajemen Pengguna</h4>
                <p class="text-muted small m-0">Kelola akses dan informasi pengguna sistem Warung Ziran</p>
            </div>
            <x-user.form-user />
        </div>

        <div class="card-body px-4 pt-0">
            <x-alert :errors="$errors" />

            <div class="table-responsive">
                <table class="table table-modern" id="table-user-modern">
                    <thead>
                        <tr>
                            <th width="80px">ID</th>
                            <th>Info Pengguna</th>
                            <th>Akses Email</th>
                            <th class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td class="text-muted font-weight-bold">#{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar mr-3">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark mb-0">{{ $user->name }}</div>
                                            <div class="text-muted small">User ID: {{ 100 + $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-email">
                                        <i class="far fa-envelope mr-1"></i> {{ $user->email }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="action-wrapper">
                                        {{-- EDIT --}}
                                        <div class="action-link link-edit">
                                            <x-user.form-user :id="$user->id" label="Edit" />
                                        </div>

                                        <div class="divider-dot"></div>

                                        {{-- RESET --}}
                                        <div class="action-link link-reset">
                                            <x-user.reset-password :id="$user->id" label="Reset" />
                                        </div>

                                        <div class="divider-dot"></div>

                                        {{-- DELETE --}}
                                        <a href="{{ route('users.destroy', $user->id) }}" class="action-link link-delete"
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
            // Inisialisasi DataTable pada ID baru
            $('#table-user-modern').DataTable({
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
                    "searchPlaceholder": "Cari pengguna...",
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });

            // Styling tambahan untuk search box datatable agar lebih cantik
            $('.dataTables_filter input').addClass('form-control-sm border-0 shadow-sm px-3').css({
                'border-radius': '20px',
                'background': '#f1f4f8',
                'width': '250px'
            });
        });
    </script>
@endpush
