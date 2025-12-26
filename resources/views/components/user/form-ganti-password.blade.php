<div>
    {{-- Trigger berupa Link Teks --}}
    <a href="javascript:void(0)" class="action-link link-reset" data-toggle="modal"
        data-target="#formGantiPassword{{ $id ?? '' }}">
        Reset
    </a>

    <div class="modal fade" id="formGantiPassword{{ $id ?? '' }}" tabindex="-1"
        aria-labelledby="formGantiPasswordLabel" aria-hidden="true">
        <form action="{{ route('users.ganti-password') }}" method="POST">
            @csrf
            {{-- Tambahkan hidden ID jika ini untuk reset password user tertentu --}}
            <input type="hidden" name="id" value="{{ $id ?? '' }}">

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                    <div class="modal-header bg-light" style="border-radius: 15px 15px 0 0;">
                        <h5 class="modal-title font-weight-bold" id="formGantiPasswordLabel">
                            <i class="fas fa-key mr-2 text-warning"></i> Atur Ulang Password
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        {{-- Password Lama (Opsional: Biasanya hanya untuk ganti password diri sendiri) --}}
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-muted">PASSWORD LAMA</label>
                            <input type="password" name="old_password"
                                class="form-control @error('old_password') is-invalid @enderror" placeholder="••••••••">
                            @error('old_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <hr>

                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-muted">PASSWORD BARU</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Min. 8 karakter">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label class="small font-weight-bold text-muted">KONFIRMASI PASSWORD</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0 pb-4 px-4 justify-content-between">
                        <button type="button" class="btn btn-light font-weight-bold text-muted" data-dismiss="modal"
                            style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-warning px-4 font-weight-bold shadow-sm"
                            style="border-radius: 8px;">
                            Update Password
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Gunakan class yang sama dengan tombol Edit sebelumnya agar konsisten */
    .link-reset {
        color: #6c757d;
        /* Warna abu-abu untuk Reset agar tidak terlalu mencolok */
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 5px 10px;
        transition: 0.2s;
        text-decoration: none !important;
    }

    .link-reset:hover {
        background: rgba(108, 117, 125, 0.1);
        color: #343a40;
        border-radius: 5px;
    }
</style>
