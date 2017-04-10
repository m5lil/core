<?php

use Illuminate\Database\Seeder;

class SettingsTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'id'       => 1,
                'set_slug' => 'إسم الموقع',
                'set_name' => 'site_name',
                'value'    => str_random(10),
                'type'     => 1,
            ],
            [
                'id'       => 7,
                'set_slug' => 'الكلمات المفتاحة',
                'set_name' => 'site_keywords',
                'value'    => 'كلمة, كلمتين, تلات كلمات',
                'type'     => 1,
            ],
            [
                'id'       => 2,
                'set_slug' => 'وصف الموقع',
                'set_name' => 'description',
                'value'    => 'وصف للموقع',
                'type'     => 2,
            ],
            [
                'id'       => 5,
                'set_slug' => 'نص الحقوق',
                'set_name' => 'copyright',
                'value'    => 'جميع الحقوق محفوظة - الرياض 2016',
                'type'     => 1,
            ],
            [
                'id'       => 8,
                'set_slug' => 'كود إحصائيات جوجل',
                'set_name' => 'analytics',
                'value'    => 'code',
                'type'     => 2,
            ],
            [
                'id'       => 6,
                'set_slug' => 'وصف الميتا تاج',
                'set_name' => 'site_meta_description',
                'value'    => 'الوصف الذى سوف يظهر فى محركات البحث إسفل إسم الموقع',
                'type'     => 2,
            ],
            [
                'id'       => 9,
                'set_slug' => 'إتجاه الموقع',
                'set_name' => 'direction',
                'value'    => 'rtl',
                'type'     => 0,
            ],
            [
                'id'       => 10,
                'set_slug' => 'حالة الموقع',
                'set_name' => 'statue',
                'value'    => 'online',
                'type'     => 0,
            ],
            [
                'id'       => 11,
                'set_slug' => 'الآى بيهات المسموح لها بدخول الموقع فى حال إغلاقه',
                'set_name' => 'ips',
                'value'    => '127.0.0.1,41.232.40.230',
                'type'     => 2,
            ],
            [
                'id'       => 3,
                'set_slug' => 'شعار الموقع',
                'set_name' => 'logo',
                'value'    => '#',
                'type'     => 0,
            ],
            [
                'id'       => 4,
                'set_slug' => 'ايقونة التفضيل',
                'set_name' => 'fav_icon',
                'value'    => '#',
                'type'     => 0,
            ],
            [
                'id'       => 12,
                'set_slug' => 'البريد الإلكتروني',
                'set_name' => 'email',
                'value'    => '#',
                'type'     => 1,
            ],
            [
                'id'       => 13,
                'set_slug' => 'ارقام هواتف',
                'set_name' => 'phone',
                'value'    => '#',
                'type'     => 1,
            ],
            [
                'id'       => 14,
                'set_slug' => 'العنوان',
                'set_name' => 'address',
                'value'    => '#',
                'type'     => 1,
            ],
            [
                'id'       => 15,
                'set_slug' => 'الرقم البريدي',
                'set_name' => 'postal',
                'value'    => '#',
                'type'     => 1,
            ],
            [
                'id'       => 18,
                'set_slug' => 'خط العرض',
                'set_name' => 'lat',
                'value'    => '#',
                'type'     => 1,
            ],
            [
                'id'       => 21,
                'set_slug' => 'خط الطول',
                'set_name' => 'lng',
                'value'    => '#',
                'type'     => 1,
            ],
            [
                'id'       => 16,
                'set_slug' => 'صفحة تويتر',
                'set_name' => 'twitter',
                'value'    => str_random(10),
                'type'     => 1,
            ],
            [
                'id'       => 17,
                'set_slug' => 'صفحة الفيس بوك',
                'set_name' => 'facebook',
                'value'    => str_random(10),
                'type'     => 1,
            ],
        ]);
    }
}
