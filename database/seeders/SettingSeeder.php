<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = Setting::firstOr(function () {
            return Setting::create([
                'site_name' => [
                    'en' => 'Dokkana',
                    'ar' => 'دكانة',
                ],
                'address' => [
                    'en' => '123 Main Street, City Center',
                    'ar' => 'شارع 123 الرئيسي، وسط البلد',
                ],
                'description' => [
                    'en' => 'Dokkana is your go-to shop for all your daily grocery needs at the best prices.',
                    'ar' => 'دكانة هي وجهتك الأولى لتلبية جميع احتياجاتك اليومية من البقالة بأفضل الأسعار.',
                ],
                'keywords' => [
                    'en' => 'dokkana, grocery, shop, supermarket, daily needs, food',
                    'ar' => 'دكانة, بقالة, سوبر ماركت, مواد غذائية, احتياجات يومية',
                ],
                'phone' => '',
                'mobile' => '',
                'whatsapp' => '',
                'email' => '',
                'email_support' => '',
                'facebook' => '',
                'twitter' => '',
                'instegram' => '',
                'youtube' => '',
                'logo' => '',
                'favicon' => '',
            ]);
        });
    }
}
