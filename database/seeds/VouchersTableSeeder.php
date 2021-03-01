<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $kode = 'JKI/V/LMR-000';
        
        for($i = 1; $i <= 50; $i++){
            DB::table('vouchers')->insert([
                'kode_voucher' => $kode.sprintf("%02s", $i),
                'nilai' => $faker->randomElement([200000, 250000, 100000, 350000, 150000]),
                'created_at' => now()
            ]);

        }
    }
}
