<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Nasabah;
use App\Models\HargaSampah;
use App\Models\Kegiatan;
use App\Models\Galeri;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@pelita016.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'no_telepon' => '081234567890',
            'alamat' => 'Jakarta Selatan'
        ]);
        
        // Create Sample Nasabah
        $user1 = User::create([
            'name' => 'Ahmad Nasabah',
            'email' => 'ahmad@example.com',
            'password' => Hash::make('password123'),
            'role' => 'nasabah',
            'no_telepon' => '081298765432',
            'alamat' => 'Jl. Merdeka No. 1'
        ]);
        
        Nasabah::create([
            'user_id' => $user1->id,
            'no_rekening' => 'PEL20240010001',
            'nik' => '3171010101010001',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'pekerjaan' => 'Wiraswasta',
            'status' => 'aktif',
            'saldo' => 500000
        ]);
        
        // Create Harga Sampah
        $sampahTypes = [
            ['Plastik', 'Non-Organik', 3000, 'Botol plastik, gelas plastik, dll'],
            ['Kertas', 'Non-Organik', 2500, 'Koran, kardus, buku bekas'],
            ['Kaca', 'Non-Organik', 1500, 'Botol kaca, beling'],
            ['Logam', 'Non-Organik', 5000, 'Kaleng, besi, alumunium'],
            ['Organik', 'Organik', 1000, 'Daun, sisa makanan'],
            ['Baterai', 'B3', 10000, 'Baterai bekas'],
            ['Elektronik', 'B3', 15000, 'HP rusak, charger, dll'],
        ];
        
        foreach ($sampahTypes as $sampah) {
            HargaSampah::create([
                'jenis_sampah' => $sampah[0],
                'kategori' => $sampah[1],
                'harga_per_kg' => $sampah[2],
                'deskripsi' => $sampah[3],
                'satuan' => 'kg',
                'status' => true
            ]);
        }
        
        // Create Sample Activities
        $activities = [
            [
                'judul' => 'Bersih-bersih Lingkungan',
                'deskripsi' => 'Kegiatan gotong royong membersihkan lingkungan sekitar',
                'lokasi' => 'RW 05 Kelurahan Hijau',
                'tanggal_mulai' => now()->addDays(7),
                'tanggal_selesai' => now()->addDays(7)->addHours(4),
                'status' => 'upcoming',
                'kuota' => 50
            ],
            [
                'judul' => 'Sosialisasi Bank Sampah',
                'deskripsi' => 'Edukasi tentang pengelolaan sampah dan manfaat bank sampah',
                'lokasi' => 'Balai Warga',
                'tanggal_mulai' => now()->addDays(14),
                'tanggal_selesai' => now()->addDays(14)->addHours(3),
                'status' => 'upcoming',
                'kuota' => 100
            ],
            [
                'judul' => 'Pelatihan Daur Ulang',
                'deskripsi' => 'Workshop membuat kerajinan dari sampah daur ulang',
                'lokasi' => 'Sekretariat Karang Taruna',
                'tanggal_mulai' => now()->addDays(21),
                'tanggal_selesai' => now()->addDays(21)->addHours(5),
                'status' => 'upcoming',
                'kuota' => 30
            ],
        ];
        
        foreach ($activities as $activity) {
            Kegiatan::create($activity);
        }
        
        // Create Sample Gallery
        for ($i = 1; $i <= 6; $i++) {
            Galeri::create([
                'judul' => 'Kegiatan Sosial ' . $i,
                'deskripsi' => 'Dokumentasi kegiatan sosial PELITA 016',
                'gambar' => 'gallery-' . $i . '.jpg',
                'kategori' => 'kegiatan',
                'tanggal_unggah' => now()->subDays(rand(1, 30)),
                'views' => rand(100, 1000)
            ]);
        }
    }
}