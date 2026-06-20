<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('cities')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $cities = [
            // 1. Gaza
            ['governorate_id' => 1, 'name' => ['en' => 'Gaza City', 'ar' => 'مدينة غزة'], 'status' => 1],
            ['governorate_id' => 1, 'name' => ['en' => 'Al-Shati Camp', 'ar' => 'مخيم الشاطئ'], 'status' => 1],
            ['governorate_id' => 1, 'name' => ['en' => 'Al-Zaytoun', 'ar' => 'الزيتون'], 'status' => 1],
            ['governorate_id' => 1, 'name' => ['en' => 'Al-Shuja\'iyya', 'ar' => 'الشجاعية'], 'status' => 1],
            ['governorate_id' => 1, 'name' => ['en' => 'Tal al-Hawa', 'ar' => 'تل الهوى'], 'status' => 1],
            ['governorate_id' => 1, 'name' => ['en' => 'Sheikh Radwan', 'ar' => 'الشيخ رضوان'], 'status' => 1],

            // 2. North Gaza
            ['governorate_id' => 2, 'name' => ['en' => 'Jabalia', 'ar' => 'جباليا'], 'status' => 1],
            ['governorate_id' => 2, 'name' => ['en' => 'Beit Lahia', 'ar' => 'بيت لاهيا'], 'status' => 1],
            ['governorate_id' => 2, 'name' => ['en' => 'Beit Hanoun', 'ar' => 'بيت حانون'], 'status' => 1],

            // 3. Deir al-Balah
            ['governorate_id' => 3, 'name' => ['en' => 'Deir al-Balah', 'ar' => 'دير البلح'], 'status' => 1],
            ['governorate_id' => 3, 'name' => ['en' => 'Nuseirat', 'ar' => 'النصيرات'], 'status' => 1],
            ['governorate_id' => 3, 'name' => ['en' => 'Bureij', 'ar' => 'البريج'], 'status' => 1],
            ['governorate_id' => 3, 'name' => ['en' => 'Maghazi', 'ar' => 'المغازي'], 'status' => 1],
            ['governorate_id' => 3, 'name' => ['en' => 'Zawaida', 'ar' => 'الزوايدة'], 'status' => 1],

            // 4. Khan Yunis
            ['governorate_id' => 4, 'name' => ['en' => 'Khan Yunis', 'ar' => 'خان يونس'], 'status' => 1],
            ['governorate_id' => 4, 'name' => ['en' => 'Bani Suheila', 'ar' => 'بني سهيلا'], 'status' => 1],
            ['governorate_id' => 4, 'name' => ['en' => 'Abasan al-Kabira', 'ar' => 'عبسان الكبيرة'], 'status' => 1],
            ['governorate_id' => 4, 'name' => ['en' => 'Khuza\'a', 'ar' => 'خزاعة'], 'status' => 1],
            ['governorate_id' => 4, 'name' => ['en' => 'Al-Qarara', 'ar' => 'القرارة'], 'status' => 1],

            // 5. Rafah
            ['governorate_id' => 5, 'name' => ['en' => 'Rafah', 'ar' => 'رفح'], 'status' => 1],
            ['governorate_id' => 5, 'name' => ['en' => 'Tal as-Sultan', 'ar' => 'تل السلطان'], 'status' => 1],
            ['governorate_id' => 5, 'name' => ['en' => 'Al-Shaboura', 'ar' => 'الشابورة'], 'status' => 1],

            // 6. Jerusalem
            ['governorate_id' => 6, 'name' => ['en' => 'Jerusalem', 'ar' => 'القدس'], 'status' => 1],

            // 7. Ramallah and Al-Bireh
            ['governorate_id' => 7, 'name' => ['en' => 'Ramallah', 'ar' => 'رام الله'], 'status' => 1],
            ['governorate_id' => 7, 'name' => ['en' => 'Al-Bireh', 'ar' => 'البيرة'], 'status' => 1],

            // 8. Nablus
            ['governorate_id' => 8, 'name' => ['en' => 'Nablus', 'ar' => 'نابلس'], 'status' => 1],

            // 9. Hebron
            ['governorate_id' => 9, 'name' => ['en' => 'Hebron', 'ar' => 'الخليل'], 'status' => 1],
            ['governorate_id' => 9, 'name' => ['en' => 'Halhul', 'ar' => 'حلحول'], 'status' => 1],
            ['governorate_id' => 9, 'name' => ['en' => 'Dura', 'ar' => 'دورا'], 'status' => 1],

            // 10. Jenin
            ['governorate_id' => 10, 'name' => ['en' => 'Jenin', 'ar' => 'جنين'], 'status' => 1],

            // 11. Tulkarm
            ['governorate_id' => 11, 'name' => ['en' => 'Tulkarm', 'ar' => 'طولكرم'], 'status' => 1],

            // 12. Qalqilya
            ['governorate_id' => 12, 'name' => ['en' => 'Qalqilya', 'ar' => 'قلقيلية'], 'status' => 1],

            // 13. Jericho
            ['governorate_id' => 13, 'name' => ['en' => 'Jericho', 'ar' => 'أريحا'], 'status' => 1],

            // 14. Tubas
            ['governorate_id' => 14, 'name' => ['en' => 'Tubas', 'ar' => 'طوباس'], 'status' => 1],

            // 15. Bethlehem
            ['governorate_id' => 15, 'name' => ['en' => 'Bethlehem', 'ar' => 'بيت لحم'], 'status' => 1],

            // 16. Salfit
            ['governorate_id' => 16, 'name' => ['en' => 'Salfit', 'ar' => 'سلفيت'], 'status' => 1],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
