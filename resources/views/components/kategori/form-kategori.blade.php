<div>
    <style>
        /* Modern Button Styling */
        .btn-modern {
            border-radius: 8px;
            padding: 8px 18px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Modal Glassmorphism Effect */
        .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 25px;
        }

        .modal-title {
            font-weight: 700;
            color: #343a40;
            letter-spacing: -0.5px;
        }

        /* Form Styling */
        .form-group label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-control-modern {
            border-radius: 10px;
            border: 1px solid #dee2e6;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control-modern:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.1);
            background-color: #fff;
        }

        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 25px;
        }
    </style>

    <button type="button" class="btn btn-modern {{ $id ? 'btn-warning text-white' : 'btn-primary' }}" data-toggle="modal"
        data-target="#formKategori{{ $id ?? '' }}">
        @if ($id)
            <i class="fas fa-edit mr-1"></i> Edit
        @else
            <i class="fas fa-plus-circle mr-1"></i> Kategori Baru
        @endif
    </button>

    <div class="modal fade" id="formKategori{{ $id ?? '' }}" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('master-data.kategori.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $id ?? '' }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="fas {{ $id ? 'fa-edit' : 'fa-folder-plus' }} text-primary mr-2"></i>
                            {{ $id ? 'Form Edit Kategori' : 'Form Kategori Baru' }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body p-4">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori"
                                class="form-control form-control-modern" placeholder="Masukkan nama kategori..."
                                value="{{ $nama_kategori ?? '' }}" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control form-control-modern" rows="5"
                                placeholder="Tambahkan deskripsi lengkap di sini...">{{ $deskripsi }}</textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-modern px-4" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-modern px-4">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
