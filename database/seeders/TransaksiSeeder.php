<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id ID');

        for ($i = 1; $i <= 15; $i++) {
            $tgl_hari_ini = date('Y-m-d');
            $jenis = $faker->randomElement(['pemasukan', 'pengeluaran']);
            $kategori_id = $faker->randomElement([1, 4, 5, 6, 7]);
            $nominal = $faker->randomElement(["100000", "200000", "300000", "400000", "50000"]);
            $ket = $faker->sentence(3);

            DB::table('transaksi')->insert([
                'tanggal' => $tgl_hari_ini,
                'jenis' => $jenis,
                'kategori_id' => $kategori_id,
                'nominal' => $nominal,
                'keterangan' => $ket
            ]);
        }
    }
}
