<?php
use App\Models\Auth\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = collect([
            [
                'nama_lengkap' => 'Admin',
                'nis_nip' => '199012012019031002',
                'role' => 1,
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'cek' => 0
            ],
            [
                'nama_lengkap' => 'Guru 1',
                'nis_nip' => '198911212008022001',
                'role' => 3,
                //'mapel_guru' => 'Bahasa Indonesia',
                'email' => 'guru@guru.com',
                'password' => Hash::make('guru'),
                'cek' => 1
            ],
            [
                'nama_lengkap' => 'Siswa 1',
                'nis_nip' => '18029122',
                'role' => 4,
                //'kelas' => '7A',
                'email' => 'siswa@siswa.com',
                'password' => Hash::make('siswa'),
                'cek' => 1
            ]
        ]);
       // $number = collect([1,2,3,4]);
        $users->each(function($data){
            User::create([
                'nama_lengkap'   => $data['nama_lengkap'],
                'nis_nip'        => $data['nis_nip'],
                'role'           => $data['role'],
                //'ruang_kalab'    => $data['ruang_kalab'],
                //'kelas'          => $data['kelas'],
                //'mapel_guru'     => $data['mapel_guru'],
                'email'          => $data['email'],
                'password'       => $data['password'],
                'cek'            => $data['cek']
            ]);
        });
        
        $laboratorium = collect([
            [
                'nama_lengkap' => 'Kepala Laboratorium 1',
                'nis_nip' => '199211272016031002',
                'role' => 2,
                'ruang_kalab' => 'Laboratorium Komputer 1',
                'email' => 'kalab1@kalab.com',
                'password' => Hash::make('kalab1'),
                'cek' => 1
            ],
            [
                'nama_lengkap' => 'Kepala Laboratorium 2',
                'nis_nip' => '199211272016031003',
                'role' => 2,
                'ruang_kalab' => 'Laboratorium Komputer 2',
                'email' => 'kalab2@kalab.com',
                'password' => Hash::make('kalab2'),
                'cek' => 1
            ],
            [
                'nama_lengkap' => 'Kepala Laboratorium 3',
                'nis_nip' => '199211272016031004',
                'role' => 2,
                'ruang_kalab' => 'Laboratorium Komputer 3',
                'email' => 'kalab3@kalab.com',
                'password' => Hash::make('kalab3'),
                'cek' => 1
            ]
        ]);
        
        $laboratorium->each(function($data){
            User::create([
                'nama_lengkap'   => $data['nama_lengkap'],
                'nis_nip'        => $data['nis_nip'],
                'role'           => $data['role'],
                'ruang_kalab'    => $data['ruang_kalab'],
                //'kelas'          => $data['kelas'],
                //'mapel_guru'     => $data['mapel_guru'],
                'email'          => $data['email'],
                'password'       => $data['password'],
                'cek'            => $data['cek']
            ]);
        });
    }
}
