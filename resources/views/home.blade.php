<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dnia Organizer | Wedding & Event Organizer</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="mainNavbar">
        <div class="container">
            <a href="#" class="logo">
                <span class="logo-icon"><i class="fas fa-ring"></i></span>
                <span class="logo-text">Dnia Organizer</span>
            </a>
            <button class="nav-toggle" onclick="toggleNav()">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-links" id="navLinks">
                <li><a href="#home" class="active">Beranda</a></li>
                <li><a href="#services">Layanan</a></li>
                <li><a href="#paket">Paket</a></li>
                <li><a href="#gallery">Galeri</a></li>
                <li><a href="#pricelist">Pricelist</a></li>
                <li><a href="#syarat-ketentuan">Syarat & Ketentuan</a></li>
                <li><a href="#testimonials">Testimoni</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-slides" id="heroSlides">
            <div class="hero-slide active" style="background-image:url('{{ asset('img/bg1.jpeg') }}');"></div>
            <div class="hero-slide" style="background-image:url('{{ asset('img/bg2.jpeg') }}');"></div>
            <div class="hero-slide" style="background-image:url('{{ asset('img/bg3.jpg') }}');"></div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <p class="hero-subtitle">Wedding & Event Organizer</p>
            <h1 class="hero-title">Mewujudkan Pernikahan Impian Anda</h1>
            <p class="hero-desc"><span id="typewriter" data-text="Kami hadir untuk menciptakan momen spesial yang tak terlupakan dengan sentuhan elegan dan profesional"></span><span class="typewriter-cursor">|</span></p>
            <div class="hero-buttons">
                <a href="#contact" class="btn btn-primary">Konsultasi Gratis</a>
                <a href="#gallery" class="btn btn-outline">Lihat Galeri</a>
            </div>
        </div>
        <div class="hero-scroll">
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Tentang Kami</span>
                <h2 class="section-title">Dnia Organizer</h2>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <p>Dnia Organizer adalah wedding dan event organizer profesional yang berdedikasi untuk mewujudkan pernikahan impian Anda. Dengan pengalaman lebih dari 5 tahun, kami telah membantu ratusan pasangan menciptakan momen sakral yang tak terlupakan.</p>
                    <p>Kami percaya bahwa setiap cinta memiliki cerita unik, dan tugas kami adalah menceritakan kisah Anda dengan sempurna melalui setiap detail pernikahan.</p>
                    <div class="about-stats">
                        <div class="stat">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Pernikahan</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">5+</span>
                            <span class="stat-label">Tahun Pengalaman</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">98%</span>
                            <span class="stat-label">Kepuasan Klien</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Layanan Kami</span>
                <h2 class="section-title">Apa yang Kami Tawarkan</h2>
            </div>
            <div class="services-grid">
                @forelse($services as $service)
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                        <a href="#contact" class="service-link">Pelajari <i class="fas fa-arrow-right"></i></a>
                    </div>
                @empty
                    <p class="text-center">Belum ada layanan tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Paket Section -->
    <section id="paket" class="packages-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Detail Paket</span>
                <h2 class="section-title">Pilihan Paket Dnia Wedding Organizer</h2>
                <p class="section-desc">Pilih paket sesuai kebutuhan acara Anda. Booking sah setelah DP minimal 10%.</p>
            </div>

            <div class="magazine-grid">
                @forelse($packages as $index => $package)
                    @if($index === 0)
                        <!-- Featured (besar) -->
                        <div class="magazine-featured">
                            <div class="magazine-overlay">
                                <h3>{{ $package->name }}</h3>
                                <p>{{ Str::limit($package->description, 90) }}</p>
                                <a href="{{ route('package.detail', $package->slug) }}" class="portfolio-btn">Lihat Detail Paket</a>
                            </div>
                            @if($package->image)
                                <div class="magazine-item magazine-package" style="background-image: url('{{ asset('storage/' . $package->image) }}');"></div>
                            @else
                                <div class="magazine-item magazine-package" style="background: linear-gradient(135deg, #eee, #ddd);"></div>
                            @endif
                        </div>

                        @if(isset($packages[1]))
                        <div class="magazine-sidebar">
                            @foreach($packages->slice(1, 2) as $sidePackage)
                                <div class="magazine-card">
                                    <div class="magazine-overlay">
                                        <h3>{{ $sidePackage->name }}</h3>
                                        <p>{{ Str::limit($sidePackage->description, 90) }}</p>
                                        <a href="{{ route('package.detail', $sidePackage->slug) }}" class="portfolio-btn">Lihat Detail Paket</a>
                                    </div>
                                    @if($sidePackage->image)
                                        <div class="magazine-item magazine-package" style="background-image: url('{{ asset('storage/' . $sidePackage->image) }}');"></div>
                                    @else
                                        <div class="magazine-item magazine-package" style="background: linear-gradient(135deg, #eee, #ddd);"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @endif
                    @endif
                @empty
                    <p class="text-center">Belum ada paket tersedia.</p>
                @endforelse
            </div>

            @if($packages->count() > 3)
            <div class="packages-grid" style="margin-top: 24px;">
                @foreach($packages->slice(3) as $package)
                    <div class="magazine-card">
                        <div class="magazine-overlay">
                            <h3>{{ $package->name }}</h3>
                            <p>{{ Str::limit($package->description, 90) }}</p>
                            <a href="{{ route('package.detail', $package->slug) }}" class="portfolio-btn">Lihat Detail Paket</a>
                        </div>
                        @if($package->image)
                            <div class="magazine-item magazine-package" style="background-image: url('{{ asset('storage/' . $package->image) }}');"></div>
                        @else
                            <div class="magazine-item magazine-package" style="background: linear-gradient(135deg, #eee, #ddd);"></div>
                        @endif
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Galeri</span>
                <h2 class="section-title">Momen Indah Bersama Dnia</h2>
                <p class="section-desc">Dokumentasi pilihan dari berbagai acara yang pernah kami tangani.</p>
            </div>

            @if($galleries->isNotEmpty())
                <div id="galleryCarousel" class="carousel slide gallery-carousel" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($galleries as $gallery)
                            <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $loop->iteration }}"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner">
                        @foreach($galleries as $gallery)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $gallery->image) }}" class="d-block w-100" alt="{{ $gallery->title }}">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $gallery->title }}</h5>
                                    @if($gallery->description)
                                        <p>{{ Str::limit($gallery->description, 140) }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @else
                <p class="text-center">Belum ada galeri tersedia.</p>
            @endif
        </div>
    </section>

    <!-- Pricelist Section -->
    <section id="pricelist" class="pricelist-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Pricelist 2025</span>
                <h2 class="section-title">Konsultasi Paket Wedding Organizer</h2>
                <p class="section-desc">Untuk informasi pricelist lengkap, jadwal booking, survey lokasi, dan fitting busana, silakan hubungi admin Dnia Organizer.</p>
            </div>

            <div class="pricelist-hero-card">
                <div>
                    <span class="pricelist-label">Dnia Makeup & Decoration</span>
                    <h3>Hubungi Kami untuk Info Lengkap</h3>
                    <p>Tim kami siap membantu Anda merencanakan pernikahan impian dengan detail yang sempurna.</p>
                </div>
                <div class="pricelist-contact">
                    <a href="tel:081280692720"><i class="fas fa-phone"></i> 0812 8069 2720</a>
                    <a href="https://www.instagram.com/dnia.makeup" target="_blank"><i class="fab fa-instagram"></i> @dnia.makeup</a>
                    <a href="https://www.instagram.com/dnia_decoration" target="_blank"><i class="fab fa-instagram"></i> @dnia_decoration</a>
                </div>
            </div>

            <div class="address-card">
                <i class="fas fa-location-dot"></i>
                <div>
                    <h3>Alamat Dnia Organizer</h3>
                    <p>Kavling Allysia No.7, Ds. Mangun Jaya, Kec. Tambun Selatan, Kab. Bekasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Syarat & Ketentuan Section -->
    <section id="syarat-ketentuan" class="terms-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Syarat & Ketentuan</span>
                <h2 class="section-title">Ketentuan Dnia Wedding Organizer</h2>
                <p class="section-desc">Informasi pembookingan, sistem pembayaran, pembatalan, lokasi acara, busana dan fitting untuk calon pengantin.</p>
            </div>

            <div class="terms-grid">
                @forelse($terms as $term)
                <div class="term-card">
                    <div class="term-icon"><i class="{{ $term->icon }}"></i></div>
                    <h3>{{ $term->title }}</h3>
                    <div class="term-content">
                        {!! nl2br(e($term->content)) !!}
                    </div>
                </div>
                @empty
                <p class="text-center">Belum ada syarat & ketentuan tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Testimoni</span>
                <h2 class="section-title">Apa Kata Klien Kami</h2>
            </div>
            <div class="testimonials-slider">
                @forelse($testimonials as $testimonial)
                    <div class="testimonial-card">
                        <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                        <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                        <div class="testimonial-author">
                            <div class="author-avatar" style="background: linear-gradient(135deg, #c9a227, #f3e5ab);"></div>
                            <div class="author-info">
                                <h4>{{ $testimonial->client_names }}</h4>
                                <p>{{ $testimonial->event_date }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada testimoni tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <div class="section-header">
                        <span class="section-tag">Hubungi Kami</span>
                        <h2 class="section-title">Mari Bicarakan Pernikahan Impian Anda</h2>
                    </div>
                    <p>Konsultasi gratis untuk perencanaan pernikahan Anda. Tim kami siap membantu mewujudkan momen spesial yang tak terlupakan.</p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Alamat</h4>
                                <p>Kavling Allysia No.7, Ds. Mangun Jaya<br>Kec. Tambun Selatan, Kab. Bekasi</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>Telepon</h4>
                                <p>0812 8069 2720</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email</h4>
                                <p>hello@dniaorganizer.com</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Jam Operasional</h4>
                                <p>Senin - Sabtu: 09.00 - 18.00 WIB</p>
                            </div>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="contact-form-wrapper">
                    <form class="contact-form" id="contactForm">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="selected-package">Paket Dipilih</label>
                            <input type="text" id="selected-package" name="selected-package" placeholder="Klik tombol 'Pilih Paket' di atas" readonly>
                        </div>
                        <div class="form-group">
                            <label for="wedding-date">Rencana Tanggal Pernikahan</label>
                            <input type="date" id="wedding-date" name="wedding-date">
                        </div>
                        <div class="form-group">
                            <label for="message">Ceritakan Kebutuhan Anda</label>
                            <textarea id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-full">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <a href="#" class="logo">
                        <span class="logo-icon"><i class="fas fa-ring"></i></span>
                        <span class="logo-text">Dnia Organizer</span>
                    </a>
                    <p>Mewujudkan pernikahan impian dengan sentuhan elegan dan profesional. Kami hadir untuk menciptakan momen spesial yang tak terlupakan.</p>
                </div>
                <div class="footer-links">
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#services">Layanan</a></li>
                        <li><a href="#paket">Paket</a></li>
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#pricelist">Pricelist</a></li>
                        <li><a href="#syarat-ketentuan">Syarat & Ketentuan</a></li>
                        <li><a href="#testimonials">Testimoni</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="#">Wedding Planning</a></li>
                        <li><a href="#">Dekorasi</a></li>
                        <li><a href="#">Entertainment</a></li>
                        <li><a href="#">Catering</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Dnia Organizer. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>