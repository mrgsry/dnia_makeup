// Mobile navigation toggle
function toggleNav() {
    const navLinks = document.getElementById('navLinks');
    navLinks.classList.toggle('show');
}

// Close mobile menu when clicking a navigation link
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        document.getElementById('navLinks').classList.remove('show');
    });
});

// Navbar active link based on scroll position + navbar effects
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-links a');
const mainNavbar = document.getElementById('mainNavbar');

function updateNavbarOnScroll() {
    const y = window.scrollY || 0;

    // Effects
    if (mainNavbar) {
        if (y <= 10) {
            mainNavbar.classList.add('navbar-transparent');
            mainNavbar.classList.remove('navbar-scrolled');
            mainNavbar.classList.remove('navbar-shrink');
        } else {
            mainNavbar.classList.remove('navbar-transparent');
            mainNavbar.classList.add('navbar-scrolled');
            if (y > 120) mainNavbar.classList.add('navbar-shrink');
            else mainNavbar.classList.remove('navbar-shrink');
        }
    }

    // Active link
    let currentSection = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 140;
        const sectionHeight = section.offsetHeight;

        if (y >= sectionTop && y < sectionTop + sectionHeight) {
            currentSection = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${currentSection}`) {
            link.classList.add('active');
        }
    });
}

window.addEventListener('scroll', updateNavbarOnScroll);
window.addEventListener('load', updateNavbarOnScroll);

// Reveal animation on scroll
const revealElements = document.querySelectorAll('.service-card, .portfolio-item, .testimonial-card, .stat, .contact-item');

revealElements.forEach(element => {
    element.classList.add('reveal');
});

const revealOnScroll = () => {
    const windowHeight = window.innerHeight;

    revealElements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const revealPoint = 120;

        if (elementTop < windowHeight - revealPoint) {
            element.classList.add('active');
        }
    });
};

window.addEventListener('scroll', revealOnScroll);
window.addEventListener('load', revealOnScroll);

// Load selected package from sessionStorage (set from package detail page)
const selectedPackageInput = document.getElementById('selected-package');
const messageInput = document.getElementById('message');

(function hydrateSelectedPackage() {
    const saved = sessionStorage.getItem('selectedPackage');
    if (!saved) return;

    if (selectedPackageInput) {
        selectedPackageInput.value = saved;
    }

    if (messageInput && !messageInput.value.trim()) {
        messageInput.value = `Halo Dnia Organizer, saya tertarik dengan ${saved}. Mohon info detail dan jadwal yang tersedia.`;
    }
})();

// Contact form demo handler
const contactForm = document.getElementById('contactForm');

if (contactForm) {
    contactForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const selectedPackage = document.getElementById('selected-package')?.value.trim() || '';
        const message = document.getElementById('message').value.trim();

        if (!name || !email || !phone || !message) {
            alert('Mohon isi semua field yang wajib diisi.');
            return;
        }

        const packageInfo = selectedPackage ? `\nPaket dipilih: ${selectedPackage}` : '';
        alert(`Terima kasih, ${name}! Pesan Anda sudah kami terima.${packageInfo}\nTim Dnia Organizer akan segera menghubungi Anda.`);
        contactForm.reset();
    });
}

// Package modal -> WhatsApp
const packageModal = document.getElementById('packageModal');
const closePackageModal = document.getElementById('closePackageModal');
const packageLeadForm = document.getElementById('packageLeadForm');
const modalPackageName = document.getElementById('modalPackageName');
const packageButtons = document.querySelectorAll('.open-package-modal');
const adminWaNumber = '6281280692720';

packageButtons.forEach(button => {
    button.addEventListener('click', function () {
        const packageName = this.getAttribute('data-package-name') || '';
        if (modalPackageName) {
            modalPackageName.value = packageName;
        }
        if (packageModal) {
            packageModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    });
});

if (closePackageModal) {
    closePackageModal.addEventListener('click', function () {
        packageModal.style.display = 'none';
        document.body.style.overflow = '';
    });
}

if (packageModal) {
    packageModal.addEventListener('click', function (event) {
        if (event.target === packageModal) {
            packageModal.style.display = 'none';
            document.body.style.overflow = '';
        }
    });
}

if (packageLeadForm) {
    packageLeadForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const packageName = modalPackageName?.value.trim() || '';
        const capengPria = document.getElementById('capengPria').value.trim();
        const capengWanita = document.getElementById('capengWanita').value.trim();
        const nomorWa = document.getElementById('nomorWa').value.trim();
        const tanggalAcara = document.getElementById('tanggalAcaraModal').value.trim();
        const lokasiAcara = document.getElementById('lokasiAcaraModal').value.trim();
        const catatan = document.getElementById('catatanModal').value.trim();

        if (!packageName || !capengPria || !capengWanita || !nomorWa) {
            alert('Mohon lengkapi data wajib terlebih dahulu.');
            return;
        }

        const text = `Halo Dnia Organizer,%0A%0ASaya ingin konsultasi paket wedding dengan data berikut:%0A%0APaket dipilih: ${encodeURIComponent(packageName)}%0ANama capeng pria: ${encodeURIComponent(capengPria)}%0ANama capeng wanita: ${encodeURIComponent(capengWanita)}%0ANomor WhatsApp: ${encodeURIComponent(nomorWa)}%0ATanggal acara: ${encodeURIComponent(tanggalAcara || '-') }%0ALokasi acara: ${encodeURIComponent(lokasiAcara || '-') }%0ACatatan tambahan: ${encodeURIComponent(catatan || '-') }%0A%0AMohon info lebih lanjut ya. Terima kasih.`;
        window.open(`https://wa.me/${adminWaNumber}?text=${text}`, '_blank');
    });
}

// Hero auto-slide
(function heroAutoSlide() {
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length < 2) return;

    let currentIndex = 0;

    const nextSlide = () => {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    };

    let slideInterval = setInterval(nextSlide, 5000);

    // Pause on hover
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.addEventListener('mouseenter', () => clearInterval(slideInterval));
        hero.addEventListener('mouseleave', () => {
            slideInterval = setInterval(nextSlide, 5000);
        });
    }
})();

// Typewriter effect
(function typewriterEffect() {
    const el = document.getElementById('typewriter');
    if (!el) return;

    const fullText = el.getAttribute('data-text') || '';
    let charIndex = 0;
    let isDeleting = false;

    const tick = () => {
        if (!isDeleting) {
            charIndex++;
            el.textContent = fullText.substring(0, charIndex);
            if (charIndex === fullText.length) {
                isDeleting = true;
                setTimeout(tick, 2000);
                return;
            }
        } else {
            charIndex--;
            el.textContent = fullText.substring(0, charIndex);
            if (charIndex === 0) {
                isDeleting = false;
                setTimeout(tick, 500);
                return;
            }
        }
        setTimeout(tick, isDeleting ? 30 : 50);
    };

    setTimeout(tick, 800);
})();

// Paket card zoom on click (klik gambar zoom, klik tombol langsung ke detail)
// DISABLED - tidak perlu zoom, tombol langsung ke detail
/*
(function packageCardZoom() {
    const packageCards = document.querySelectorAll('.magazine-package');
    
    packageCards.forEach(card => {
        const image = card;
        const detailBtn = card.closest('.magazine-featured, .magazine-card')?.querySelector('.package-detail-btn');
        
        if (image) {
            image.addEventListener('click', function(e) {
                e.stopPropagation();
                card.classList.toggle('zoomed');
            });
        }
        
        if (detailBtn) {
            detailBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                // Tombol langsung ke detail, tidak zoom
            });
        }
    });
})();
*/

// Smooth scroll fallback for older browsers
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (event) {
        const targetId = this.getAttribute('href');

        if (targetId.length > 1) {
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                event.preventDefault();
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});
