<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $count = DB::table('regions')->count();
        if ($count > 0) {
            echo "ℹ️ Таблица regions уже заполнена ($count записей)\n";
            return;
        }

        $regions = [
            1  => ['Ташкент',                        'Toshkent'],
            2  => ['Ташкентская область',            'Toshkent viloyati'],
            3  => ['Андижанская область',            'Andijon viloyati'],
            4  => ['Бухарская область',              'Buxoro viloyati'],
            5  => ['Джизакская область',             'Jizzax viloyati'],
            6  => ['Кашкадарьинская область',        'Qashqadaryo viloyati'],
            7  => ['Навоийская область',             'Navoiy viloyati'],
            8  => ['Наманганская область',           'Namangan viloyati'],
            9  => ['Самаркандская область',          'Samarqand viloyati'],
            10 => ['Сурхандарьинская область',       'Surxondaryo viloyati'],
            11 => ['Сырдарьинская область',          'Sirdaryo viloyati'],
            12 => ['Ферганская область',             "Farg'ona viloyati"],
            13 => ['Хорезмская область',             'Xorazm viloyati'],
            14 => ['Республика Каракалпакстан',      "Qoraqalpog'iston Respublikasi"],
        ];

        foreach ($regions as $id => [$name_ru, $name_uz]) {
            DB::table('regions')->insert([
                'id' => $id,
                'name_ru' => $name_ru,
                'name_uz' => $name_uz,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "✅ Заполнена таблица regions (14 записей)\n";
    }
}