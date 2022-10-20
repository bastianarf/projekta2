<?php
use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barang = collect([
            [
                'users_id'    => 1,
                'kode_barang' => '6217281929',
                'nama_barang' => 'LCD Monitor',
                'qty_barang' => 10,
                'ruangan_barang' => 'Laboratorium Komputer 1',
                'merk_barang' => 'LG',
                'warna_barang' => 'Merah',
                'kondisi_barang' => 'Baik',
                'catatan_barang' => 'Layar 15 inch'    
            ],
            [
                'users_id'    => 1,
                'kode_barang' => '6217221908',
                'nama_barang' => 'Wifi Adapter',
                'qty_barang' => 15,
                'ruangan_barang' => 'Laboratorium Komputer 3',
                'merk_barang' => 'Prolink',
                'warna_barang' => 'Hitam',
                'kondisi_barang' => 'Baik',
                'catatan_barang' => 'USB WiFi Adapter kecil'    
            ],
            [
                'users_id'    => 4,
                'kode_barang' => '6217281769',
                'nama_barang' => 'Mouse',
                'qty_barang' => 7,
                'ruangan_barang' => 'Laboratorium Komputer 1',
                'merk_barang' => 'Sturdy',
                'warna_barang' => 'Hitam',
                'kondisi_barang' => 'Baik',
                'catatan_barang' => 'Sturdy versi 2015'    
            ],
            [
                'users_id'    => 4,
                'kode_barang' => '6217281791',
                'nama_barang' => 'Flashdisk',
                'qty_barang' => 2,
                'ruangan_barang' => 'Laboratorium Komputer 1',
                'merk_barang' => 'Cruzer Blade',
                'warna_barang' => 'Merah',
                'kondisi_barang' => 'Baik',
                'catatan_barang' => 'Ukuran 16GB'    
            ],
            [
                'users_id'    => 5,
                'kode_barang' => '621728239',
                'nama_barang' => 'LED Monitor',
                'qty_barang' => 5,
                'ruangan_barang' => 'Laboratorium Komputer 2',
                'merk_barang' => 'Hitachi',
                'warna_barang' => 'Biru',
                'kondisi_barang' => 'Baik',
                'catatan_barang' => 'Layar 13 inch'    
            ],
            [
                'users_id'    => 5,
                'kode_barang' => '6217281711',
                'nama_barang' => 'Flashdisk',
                'qty_barang' => 1,
                'ruangan_barang' => 'Laboratorium Komputer 2',
                'merk_barang' => 'Kingston',
                'warna_barang' => 'Putih',
                'kondisi_barang' => 'Rusak',
                'catatan_barang' => 'Ukuran 32 GB'    
            ],
            [
                'users_id'    => 6,
                'kode_barang' => '6217281229',
                'nama_barang' => 'Headphone',
                'qty_barang' => 15,
                'ruangan_barang' => 'Laboratorium Komputer 3',
                'merk_barang' => 'Sennheiser',
                'warna_barang' => 'Hitam',
                'kondisi_barang' => 'Baik',
                'catatan_barang' => 'Headphone'  
            ],
            [
                'users_id'    => 6,
                'kode_barang' => '6217281729',
                'nama_barang' => 'HDD External Harddisk',
                'qty_barang' => 2,
                'ruangan_barang' => 'Laboratorium Komputer 3',
                'merk_barang' => 'Seagate',
                'warna_barang' => 'Hitam',
                'kondisi_barang' => 'Baik',
                'catatan_barang' => 'Ukuran 250GB'  
            ],

        ]);
        $barang->each(function($data){
            Barang::create([
                'users_id'      => $data['users_id'],
                'kode_barang'   => $data['kode_barang'],
                'nama_barang'   => $data['nama_barang'],
                'qty_barang'    => $data['qty_barang'],
                'ruangan_barang'=> $data['ruangan_barang'],
                'merk_barang'   => $data['merk_barang'],
                'warna_barang'  => $data['warna_barang'],
                'kondisi_barang'=> $data['kondisi_barang'],
                'catatan_barang'=> $data['catatan_barang']
            ]);
        });
    }
}
