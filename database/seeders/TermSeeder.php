<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        $terms = [
            [
                'title' => 'Pembookingan',
                'icon' => 'fa fa-calendar-check-o',
                'content' => "Menentukan tanggal acara dengan melakukan pembookingan.\nBooking dianggap sah apabila sudah melakukan DP senilai 10% dari harga paket.\nSetelah DP masuk, tanggal tidak bisa diubah kecuali ada perjanjian tertentu saat booking.",
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Sistem Pembayaran',
                'icon' => 'fa fa-money',
                'content' => "Paket Lengkap Dekorasi & Makeup Acara di Rumah:\n1. DP minimal 10% saat booking.\n2. Pembayaran 50% di H-2 minggu sebelum acara, boleh saat survey dan fitting.\n3. Pelunasan di H+1 setelah acara, maksimal jam 12.00.\n\nPaket Rias & Busana:\n1. DP minimal 10%.\n2. Pembayaran 50% saat fitting busana.\n3. Pelunasan saat H+1 acara, maksimal jam 12.00.",
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Pembatalan Kesepakatan',
                'icon' => 'fa fa-ban',
                'content' => "Klien yang sudah melakukan DP tidak dapat melakukan pembatalan sepihak dengan alasan apapun.\nJika klien melakukan pembatalan, pembayaran DP tidak dapat dikembalikan atau hangus.\nPerpindahan dari paket besar ke paket lebih kecil dikenakan charge Rp 500.000.\nAcara bisa diundur, namun tidak bisa dibatalkan.",
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Lokasi Acara',
                'icon' => 'fa fa-map-marker',
                'content' => "Lokasi acara yang menggunakan dekorasi dari kami diusahakan bisa diakses mobil.\nJika lokasi tidak bisa diakses mobil, dikenakan charge jasa kuli Rp 500.000.\nSurvey lokasi minimal 1 bulan sebelum acara dan sudah melakukan DP.\nLokasi yang sudah disurvey tidak dapat pindah. Jika pindah setelah survey, dikenakan charge Rp 500.000.\nAda tambahan cash transport untuk lokasi tertentu, terutama area dengan jarak lebih dari 1 jam dari gudang Dnia Wedding.",
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Busana & Fitting',
                'icon' => 'fa fa-tshirt',
                'content' => "Jadwal fitting diberikan admin Dnia Wedding minimal 1 bulan sebelum acara.\nSaat fitting, klien diharapkan datang tepat waktu karena ada jadwal fitting klien lain.\nFitting diperbolehkan untuk pengantin dan orang tua, yaitu pihak hajat dan besan. Selain itu cukup siapkan ukuran.\nFitting hanya dilakukan sekali dan tidak dapat menukar baju.\nBusana pengantin pria diambil ke gallery 2 hari sebelum acara. Jika ingin via GoSend, ongkir ditanggung pengantin.\nPengantin pria wajib membawa sepatu pantofel dan kemeja saat memakai jas resepsi.\nBusana di Gallery Dnia Wedding tersedia sampai LD 125 cm. Jika calon pengantin melebihi LD tersebut, dikenakan charge pembuatan busana baru/custom.",
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($terms as $term) {
            Term::updateOrCreate(
                ['title' => $term['title']],
                $term
            );
        }
    }
}
