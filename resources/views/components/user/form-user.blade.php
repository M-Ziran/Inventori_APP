<div>
    {{-- Trigger menggunakan Link Teks untuk Edit, tetap tombol untuk User Baru --}}
    @if ($id)
        <a href="javascript:void(0)" class="action-link link-edit" data-toggle="modal"
            data-target="#formUser{{ $id }}">
            Edit
        </a>
    @else
        <button type="button" class="btn btn-primary shadow-sm" style="border-radius: 8px;" data-toggle="modal"
            data-target="#formUser">
            <i class="fas fa-plus mr-1"></i> User Baru
        </button>
    @endif

    <div class="modal fade" id="formUser{{ $id ?? '' }}" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $id ?? '' }}">
            <div class="modal-dialog modal-dialog-centered"> {{-- Tambahan: modal-dialog-centered agar lebih modern --}}
                <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                    <div class="modal-header bg-light" style="border-radius: 15px 15px 0 0;">
                        <h5 class="modal-title font-weight-bold">
                            {{ $id ? 'Edit Data Pengguna' : 'Tambah Pengguna Baru' }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-muted">EMAIL</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ $id ? $email : old('email') }}" required placeholder="contoh@email.com">
                        </div>
                        <div class="form-group mb-0">
                            <label class="small font-weight-bold text-muted">NAMA LENGKAP</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ $id ? $name : old('name') }}" required placeholder="Masukkan nama pengguna">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0 pb-4 px-4 justify-content-between">
                        <button type="button" class="btn btn-light font-weight-bold text-muted" data-dismiss="modal"
                            style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 font-weight-bold"
                            style="border-radius: 8px;">
                            {{ $id ? 'Simpan Perubahan' : 'Daftarkan User' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
