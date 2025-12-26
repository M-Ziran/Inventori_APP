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

        /* Modal Content */
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

        /* Form Styling */
        .form-group label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .form-control-modern {
            border-radius: 10px;
            border: 1px solid #dee2e6;
            padding: 10px 15px;
            transition: all 0.3s ease;
            height: auto;
        }

        .form-control-modern:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.1);
        }

        /* Checkbox Switch Look */
        .custom-switch-label {
            font-weight: 600;
            cursor: pointer;
        }
    </style>

    <button type="button" class="btn btn-modern {{ $id ? 'btn-warning text-white' : 'btn-primary' }}" data-toggle="modal"
        data-target="#formProduct{{ $id ?? '' }}">
        @if ($id)
            <i class="fas fa-edit mr-1"></i>
        @else
            <i class="fas fa-plus-circle mr-1"></i> Product Baru
        @endif
    </button>

    <div class="modal fade" id="formProduct{{ $id ?? '' }}" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('master-data.product.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $id ?? '' }}">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold">
                            <i class="fas {{ $id ? 'fa-box-open' : 'fa-box' }} text-primary mr-2"></i>
                            {{ $id ? 'Edit Product' : 'Tambah Product Baru' }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-7 border-right">
                                <div class="form-group mb-3">
                                    <label>Nama Product</label>
                                    <input type="text" name="nama_product" class="form-control form-control-modern"
                                        placeholder="Contoh: Kopi Gula Aren"
                                        value="{{ $id ? $nama_product : old('nama_product') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Kategori Product</label>
                                    <select name="kategori_id" class="form-control form-control-modern" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $kategori_id == $item->id || old('kategori_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="is_active"
                                            id="is_active{{ $id }}"
                                            {{ old('is_active', $id ? $is_active : false) ? 'checked' : '' }}>
                                        <label class="custom-control-label custom-switch-label"
                                            for="is_active{{ $id }}">Produk Aktif?</label>
                                    </div>
                                    <small class="text-muted d-block mt-1">Jika aktif, produk muncul di menu
                                        kasir.</small>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group mb-3">
                                    <label>Harga Jual (Rp)</label>
                                    <input type="number" name="harga_jual"
                                        class="form-control form-control-modern font-weight-bold text-primary"
                                        value="{{ $id ? $harga_jual : old('harga_jual') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Harga Beli Pokok (Rp)</label>
                                    <input type="number" name="harga_beli_pokok"
                                        class="form-control form-control-modern"
                                        value="{{ $id ? $harga_beli_pokok : old('harga_beli_pokok') }}" required>
                                </div>
                                <div class="row">
                                    <div class="col-6 border-right">
                                        <div class="form-group mb-0">
                                            <label>Stok</label>
                                            <input type="number" name="stok"
                                                class="form-control form-control-modern"
                                                value="{{ $id ? $stok : old('stok') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-0">
                                            <label>Min. Stok</label>
                                            <input type="number" name="stok_minimal"
                                                class="form-control form-control-modern"
                                                value="{{ $id ? $stok_minimal : old('stok_minimal') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-modern px-4" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-modern px-4">
                            <i class="fas fa-save mr-1"></i> Simpan Data
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
