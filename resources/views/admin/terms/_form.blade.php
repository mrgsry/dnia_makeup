@php
    $iconOptions = [
        'fa fa-info-circle' => 'Info',
        'fa fa-calendar-check-o' => 'Calendar Check',
        'fa fa-money' => 'Money',
        'fa fa-ban' => 'Ban',
        'fa fa-map-marker' => 'Location',
        'fa fa-tshirt' => 'T-Shirt',
        'fa fa-list-alt' => 'List',
        'fa fa-check-circle' => 'Check',
        'fa fa-warning' => 'Warning',
        'fa fa-book' => 'Book',
    ];
    $selectedIcon = old('icon', $term->icon ?? 'fa fa-info-circle');
@endphp

<div class="card-body">
    <div class="form-group">
        <label>Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $term->title ?? '') }}" placeholder="Contoh: Pembookingan">
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>Icon</label>
        <div class="d-flex align-items-center" style="gap:12px;">
            <div style="width:44px;height:44px;border-radius:10px;background:#fff;display:flex;align-items:center;justify-content:center;border:1px solid #e5e5e5;">
                <i id="iconPreview" class="{{ $selectedIcon }} text-gold fa-2x"></i>
            </div>
            <div class="flex-grow-1">
                <select class="form-control @error('icon') is-invalid @enderror" name="icon" id="iconSelect">
                    @foreach($iconOptions as $value => $label)
                        <option value="{{ $value }}" {{ $selectedIcon === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Icon pakai Font Awesome 4 (sesuai AdminLTE).</small>
                @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Konten</label>
        <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="8" placeholder="Tulis isi syarat & ketentuan di sini (boleh pakai bullet/angka).">{{ old('content', $term->content ?? '') }}</textarea>
        <small class="form-text text-muted">Boleh isi dengan format angka (1., 2., 3.) atau bullet (- ...). Nanti ditampilkan di website.</small>
        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" name="sort_order" value="{{ old('sort_order', $term->sort_order ?? 0) }}" min="0">
                <small class="form-text text-muted">Semakin kecil, tampil lebih dulu.</small>
                @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Status</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $term->is_active ?? true) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_active">Aktif</label>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var select = document.getElementById('iconSelect');
        var preview = document.getElementById('iconPreview');
        if (!select || !preview) return;

        var sync = function() {
            preview.className = select.value + ' text-gold fa-2x';
        };

        select.addEventListener('change', sync);
        sync();
    });
</script>
@endpush
