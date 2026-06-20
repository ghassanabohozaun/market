<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        DB::table('countries')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $countries = [
            [
                'id' => 1,
                'phone_code' => '970',
                'name' => [
                    'en' => 'Palestine',
                    'ar' => 'فلسطين',
                ],
                'flag_code' => 'ps',
            ],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(['id' => $country['id']], $country);
        }
    }
}
