<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wallet::create([
            'address' => '0xaa7a9ca87d3694b5755f213b5d04094b8d0f0a6f',
            'username' => 'tracelabs',
            'email' => 'tracelabs@mail.com'
        ]);
    }
}
