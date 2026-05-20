<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'slug' => 'mini',
                'name' => 'Paket Dnia Wedding Mini',
                'description' => 'Paket ringkas untuk acara intimate dengan kebutuhan utama wedding organizer.',
                'facilities' => [
                    'Konsultasi dan perencanaan konsep acara',
                    'Koordinasi rundown acara dari awal sampai selesai',
                    'Tim wedding organizer pada hari-H',
                    'Pendampingan teknis untuk keluarga dan calon pengantin',
                    'Koordinasi vendor yang sudah dipilih',
                ],
            ],
            [
                'slug' => 'silver',
                'name' => 'Paket Dnia Wedding Silver',
                'description' => 'Paket menengah dengan dukungan wedding organizer lebih lengkap untuk acara yang lebih ramai.',
                'facilities' => [
                    'Semua fasilitas Paket Mini',
                    'Survey lokasi acara sebelum hari-H',
                    'Pendampingan gladi/resikapan rundown acara',
                    'Koordinasi vendor dekorasi, makeup, dan dokumentasi',
                    'Tim WO tambahan untuk handling tamu dan keluarga inti',
                ],
            ],
            [
                'slug' => 'vip',
                'name' => 'Paket Dnia Wedding VIP',
                'description' => 'Paket premium dengan layanan prioritas untuk kenyamanan maksimal calon pengantin.',
                'facilities' => [
                    'Semua fasilitas Paket Silver',
                    'Pendampingan intensif persiapan H-30 sampai hari-H',
                    'Detail checklist kebutuhan acara',
                    'Manajemen waktu acara dan antisipasi kendala lapangan',
                    'Koordinasi menyeluruh antar keluarga, vendor, dan tim pelaksana',
                ],
            ],
            [
                'slug' => 'diamond',
                'name' => 'Paket Dnia Wedding Diamond',
                'description' => 'Paket eksekutif dengan pelayanan lengkap untuk acara besar dan detail yang kompleks.',
                'facilities' => [
                    'Semua fasilitas Paket VIP',
                    'Pendampingan penuh pada sesi penting (fitting, final check, briefing)',
                    'Penanganan alur tamu VVIP dan keluarga besar',
                    'Supervisi intensif area acara dari persiapan hingga selesai',
                    'After-event follow up dan evaluasi pelaksanaan acara',
                ],
            ],
            [
                'slug' => 'aula',
                'name' => 'Paket Dnia Wedding Aula',
                'description' => 'Paket khusus untuk acara di gedung/aula dengan kebutuhan koordinasi venue yang lebih detail.',
                'facilities' => [
                    'Semua fasilitas Paket Silver',
                    'Koordinasi teknis dengan pengelola gedung/aula',
                    'Pengaturan alur masuk tamu dan alur acara di venue',
                    'Koordinasi loading vendor sesuai aturan venue',
                    'Kontrol timeline setup dan breakdown area acara',
                ],
            ],
            [
                'slug' => 'glamour',
                'name' => 'Paket Dnia Wedding Glamour',
                'description' => 'Paket paling lengkap untuk pengalaman wedding mewah dengan pelayanan maksimal.',
                'facilities' => [
                    'Semua fasilitas Paket Diamond',
                    'Pendampingan eksklusif dan prioritas penuh',
                    'Manajemen detail acara dari pra-acara hingga pasca-acara',
                    'Koordinasi ekstra untuk konsep acara tematik/luxury',
                    'Tim support lebih banyak untuk menjaga kelancaran seluruh rangkaian acara',
                ],
            ],
        ];

        foreach ($packages as $package) {
            Package::updateOrCreate(
                ['slug' => $package['slug']],
                $package
            );
        }
    }
}
