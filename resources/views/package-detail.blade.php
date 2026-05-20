<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $package->name }} | Dnia Organizer</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;6\u003d\u0026display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Nav -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="logo">
                <span class="logo-icon"><i class="fas fa-ring"></i></span>
                <span class="logo-text">Dnia Organizer</span>
            </a>
            <button class="nav-toggle" onclick="toggleNav()"><i class="fas fa-bars"></i></button>
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}#services">Layanan</a></li>
                <li><a href="{{ route('home') }}#portfolio">Portfolio</a></li>
                <li><a href="{{ route('home') }}#contact">Kontak</a></li>
            </ul>
        </div>
    </nav>

    <section class="package-detail-hero">
        <div class="container">
            @if($package->image)
                <div style="height: 360px; border-radius: 28px; overflow: hidden; margin-bottom: 28px; box-shadow: 0 24px 60px rgba(0,0,0,0.12);">
                    <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                </div>
            @endif

            <div class="package-detail-card">
                <span class="package-detail-tag">Detail Paket</span>
                <h1 class="package-detail-title">{{ $package->name }}</h1>
                <p class="package-detail-desc">{{ $package->description }}</p>

                <div class="package-detail-actions">
                    <button type="button" class="btn btn-primary open-package-modal" data-package-name="{{ $package->name }}">Pilih Paket Ini</button>
                    <a class="btn btn-outline" href="{{ route('home') }}#paket">Kembali</a>
                </div>
            </div>

            <div class="package-includes">
                <h2>Apa yang didapat</h2>
                <ul>
                    @foreach($package->facilities as $item)
                        <li><i class="fas fa-check-circle"></i> {{ $item }}</li>
                    @endforeach
                </ul>

                <div class="package-note">
                    <strong>Catatan:</strong>
                    <p>Booking dianggap sah setelah DP minimal 10% dari paket yang dipilih. Jadwal dan detail dapat disesuaikan saat konsultasi.</p>
                </div>
            </div>
        </div>
    </section>

    <div id="packageModal" class="package-modal-overlay" style="display:none;">
        <div class="package-modal-box">
            <button type="button" class="package-modal-close" id="closePackageModal">&times;</button>
            <h3>Form Data Calon Pengantin</h3>
            <p style="margin-bottom:18px;color:#777;">Lengkapi data berikut, lalu klik submit untuk lanjut ke WhatsApp.</p>
            <form id="packageLeadForm">
                <input type="hidden" id="modalPackageName" name="package_name" value="{{ $package->name }}">
                <div class="form-group">
                    <label for="capengPria">Nama Calon Pengantin Pria</label>
                    <input type="text" id="capengPria" name="capeng_pria" required>
                </div>
                <div class="form-group">
                    <label for="capengWanita">Nama Calon Pengantin Wanita</label>
                    <input type="text" id="capengWanita" name="capeng_wanita" required>
                </div>
                <div class="form-group">
                    <label for="nomorWa">Nomor WhatsApp</label>
                    <input type="text" id="nomorWa" name="nomor_wa" required>
                </div>
                <div class="form-group">
                    <label for="tanggalAcaraModal">Tanggal Acara</label>
                    <input type="date" id="tanggalAcaraModal" name="tanggal_acara">
                </div>
                <div class="form-group">
                    <label for="lokasiAcaraModal">Lokasi Acara</label>
                    <input type="text" id="lokasiAcaraModal" name="lokasi_acara" placeholder="Contoh: Bekasi">
                </div>
                <div class="form-group">
                    <label for="catatanModal">Catatan Tambahan</label>
                    <textarea id="catatanModal" name="catatan" rows="3" placeholder="Tulis kebutuhan atau catatan tambahan..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Kirim ke WhatsApp</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
