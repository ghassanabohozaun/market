<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('governorates')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $governorates = [
            ['id' => 1, 'country_id' => 1, 'name' => ['en' => 'Gaza', 'ar' => 'غزة'], 'status' => 1],
            ['id' => 2, 'country_id' => 1, 'name' => ['en' => 'North Gaza', 'ar' => 'شمال غزة'], 'status' => 1],
            ['id' => 3, 'country_id' => 1, 'name' => ['en' => 'Deir al-Balah', 'ar' => 'دير البلح'], 'status' => 1],
            ['id' => 4, 'country_id' => 1, 'name' => ['en' => 'Khan Yunis', 'ar' => 'خان يونس'], 'status' => 1],
            ['id' => 5, 'country_id' => 1, 'name' => ['en' => 'Rafah', 'ar' => 'رفح'], 'status' => 1],
            ['id' => 6, 'country_id' => 1, 'name' => ['en' => 'Jerusalem', 'ar' => 'القدس'], 'status' => 1],
            ['id' => 7, 'country_id' => 1, 'name' => ['en' => 'Ramallah and Al-Bireh', 'ar' => 'رام الله والبيرة'], 'status' => 1],
            ['id' => 8, 'country_id' => 1, 'name' => ['en' => 'Nablus', 'ar' => 'نابلس'], 'status' => 1],
            ['id' => 9, 'country_id' => 1, 'name' => ['en' => 'Hebron', 'ar' => 'الخليل'], 'status' => 1],
            ['id' => 10, 'country_id' => 1, 'name' => ['en' => 'Jenin', 'ar' => 'جنين'], 'status' => 1],
            ['id' => 11, 'country_id' => 1, 'name' => ['en' => 'Tulkarm', 'ar' => 'طولكرم'], 'status' => 1],
            ['id' => 12, 'country_id' => 1, 'name' => ['en' => 'Qalqilya', 'ar' => 'قلقيلية'], 'status' => 1],
            ['id' => 13, 'country_id' => 1, 'name' => ['en' => 'Jericho', 'ar' => 'أريحا'], 'status' => 1],
            ['id' => 14, 'country_id' => 1, 'name' => ['en' => 'Tubas', 'ar' => 'طوباس'], 'status' => 1],
            ['id' => 15, 'country_id' => 1, 'name' => ['en' => 'Bethlehem', 'ar' => 'بيت لحم'], 'status' => 1],
            ['id' => 16, 'country_id' => 1, 'name' => ['en' => 'Salfit', 'ar' => 'سلفيت'], 'status' => 1],
        ];

        foreach ($governorates as $gov) {
            Governorate::updateOrCreate(['id' => $gov['id']], $gov);
        }
    }
}
