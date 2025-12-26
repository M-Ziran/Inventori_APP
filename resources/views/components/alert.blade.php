@if ($errors->any())
    <div class="alert alert-{{ $type ?? 'danger' }} shadow-sm border-0 d-flex align-items-center" role="alert"
        style="border-radius: 12px;">
        {{-- Ikon pendukung sesuai tipe alert --}}
        <div class="mr-3">
            @if (($type ?? 'danger') == 'danger')
                <i class="fas fa-exclamation-circle fa-lg"></i>
            @elseif($type == 'warning')
                <i class="fas fa-exclamation-triangle fa-lg"></i>
            @else
                <i class="fas fa-info-circle fa-lg"></i>
            @endif
        </div>

        <div>
            <strong class="d-block mb-1" style="font-size: 0.9rem;">Terjadi Kesalahan:</strong>
            @foreach ($errors->all() as $error)
                <small class="d-block opacity-8">{{ $error }}</small>
            @endforeach
        </div>

        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<style>
    .alert {
        padding: 1rem 1.25rem;
    }

    .opacity-8 {
        opacity: 0.85;
    }
</style>
