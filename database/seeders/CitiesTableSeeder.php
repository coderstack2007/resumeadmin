<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CitiesTableSeeder extends Seeder
{
    public function run(): void
    {
        $count = DB::table('cities')->count();
        if ($count > 0) {
            echo "ℹ️ Таблица cities уже заполнена ($count записей)\n";
            return;
        }

        $cities = [
            // Регион 1 — Ташкент
            101 => [1, 'Чиланзар',       'Chilonzor'],
            102 => [1, 'Юнусабад',       'Yunusobod'],
            103 => [1, 'Мирабад',        'Mirobod'],
            104 => [1, 'Сергели',        'Sergeli'],
            105 => [1, 'Алмазар',        'Olmazor'],
            106 => [1, 'Яккасарай',      'Yakkasaroy'],
            107 => [1, 'Шайхантахур',    'Shayhontohur'],
            108 => [1, 'Учтепа',         'Uchtepa'],
            109 => [1, 'Бектемир',       'Bektemir'],
            110 => [1, 'Яшнабад',        'Yashnobod'],
            111 => [1, 'Мирзо-Улугбек',  "Mirzo Ulug'bek"],

            // Регион 2 — Ташкентская область
            201 => [2, 'Ангрен',         'Angren'],
            202 => [2, 'Алмалык',        'Olmaliq'],
            203 => [2, 'Бекабад',        'Bekobod'],
            204 => [2, 'Чирчик',         'Chirchiq'],
            205 => [2, 'Янгиюль',        "Yangiyo'l"],
            206 => [2, 'Нурафшон',       'Nurafshon'],
            207 => [2, 'Ахангаран',      'Ohangaron'],
            208 => [2, 'Паркент',        'Parkent'],
            209 => [2, 'Бука',           "Bo'ka"],
            210 => [2, 'Газалкент',      "G'azalkent"],

            // Регион 3 — Андижанская область
            301 => [3, 'Андижан',        'Andijon'],
            302 => [3, 'Асака',          'Asaka'],
            303 => [3, 'Шахрихан',       'Shahrixon'],
            304 => [3, 'Ханабад',        'Xonobod'],
            305 => [3, 'Пайтуг',         "Paytug'"],
            306 => [3, 'Мархамат',       'Marhamat'],
            307 => [3, 'Кургантепа',     "Qo'rg'ontepa"],
            308 => [3, 'Ходжаабад',      "Xo'jaobod"],
            309 => [3, 'Балыкчи',        'Baliqchi'],
            310 => [3, 'Избоскан',       'Izboskan'],

            // Регион 4 — Бухарская область
            401 => [4, 'Бухара',         'Buxoro'],
            402 => [4, 'Каган',          'Kogon'],
            403 => [4, 'Галляарал',      "G'allaoral"],
            404 => [4, 'Газли',          "G'azli"],
            405 => [4, 'Каракуль',       "Qorako'l"],
            406 => [4, 'Вабкент',        'Vobkent'],
            407 => [4, 'Жондор',         'Jondor'],
            408 => [4, 'Ромитан',        'Romitan'],
            409 => [4, 'Шафиркан',       'Shofirkon'],
            410 => [4, 'Гиждуван',       "G'ijduvon"],

            // Регион 5 — Джизакская область
            501 => [5, 'Джизак',         'Jizzax'],
            502 => [5, 'Галляарал',      "G'allaoral"],
            503 => [5, 'Дустлик',        "Do'stlik"],
            504 => [5, 'Пахтакор',       'Paxtakor'],
            505 => [5, 'Зафарабад',      'Zafarobod'],
            506 => [5, 'Зарбдор',        'Zarbdor'],
            507 => [5, 'Зомин',          'Zomin'],
            508 => [5, 'Бахмал',         'Baxmal'],
            509 => [5, 'Фориш',          'Forish'],
            510 => [5, 'Мирзачуль',      "Mirzacho'l"],

            // Регион 6 — Кашкадарьинская область
            601 => [6, 'Карши',          'Qarshi'],
            602 => [6, 'Шахрисабз',      'Shahrisabz'],
            603 => [6, 'Китаб',          'Kitob'],
            604 => [6, 'Гузар',          "G'uzor"],
            605 => [6, 'Мубарек',        'Muborak'],
            606 => [6, 'Касан',          'Koson'],
            607 => [6, 'Камаши',         'Kamashi'],
            608 => [6, 'Яккабаг',        "Yakkabog'"],
            609 => [6, 'Чиракчи',        'Chiroqchi'],
            610 => [6, 'Нишан',          'Nishon'],

            // Регион 7 — Навоийская область
            701 => [7, 'Навои',          'Navoiy'],
            702 => [7, 'Зарафшан',       'Zarafshon'],
            703 => [7, 'Кармана',        'Karmana'],
            704 => [7, 'Учкудук',        'Uchquduq'],
            705 => [7, 'Нурата',         'Nurota'],
            706 => [7, 'Кызылтепа',      'Qiziltepa'],
            707 => [7, 'Хатырчи',        'Xatirchi'],
            708 => [7, 'Тамдыбулак',     'Tamdibuloq'],
            709 => [7, 'Конимех',        'Konimex'],
            710 => [7, 'Навбахор',       'Navbahor'],

            // Регион 8 — Наманганская область
            801 => [8, 'Наманган',       'Namangan'],
            802 => [8, 'Хаккулабад',     'Xaqqulobod'],
            803 => [8, 'Чуст',           'Chust'],
            804 => [8, 'Касансай',       'Kosonsoy'],
            805 => [8, 'Туракурган',     "To'raqo'rg'on"],
            806 => [8, 'Учкурган',       "Uchqo'rg'on"],
            807 => [8, 'Пап',            'Pop'],
            808 => [8, 'Мингбулак',      'Mingbuloq'],
            809 => [8, 'Янгикурган',     "Yangiqo'rg'on"],
            810 => [8, 'Чартак',         'Chortoq'],

            // Регион 9 — Самаркандская область
            901 => [9, 'Самарканд',      'Samarqand'],
            902 => [9, 'Каттакурган',    "Kattaqo'rg'on"],
            903 => [9, 'Булунгур',       "Bulung'ur"],
            904 => [9, 'Джамбай',        'Jomboy'],
            905 => [9, 'Иштыхан',        'Ishtixon'],
            906 => [9, 'Акдарья',        'Oqdaryo'],
            907 => [9, 'Пайарык',        'Payariq'],
            908 => [9, 'Ургут',          'Urgut'],
            909 => [9, 'Нурабад',        'Nurobod'],
            910 => [9, 'Челек',          'Chelak'],

            // Регион 10 — Сурхандарьинская область
            1001 => [10, 'Термез',       'Termiz'],
            1002 => [10, 'Денау',        'Denov'],
            1003 => [10, 'Шурчи',        "Sho'rchi"],
            1004 => [10, 'Байсун',       'Boysun'],
            1005 => [10, 'Кумкурган',    "Qumqo'rg'on"],
            1006 => [10, 'Джаркурган',   "Jarqo'rg'on"],
            1007 => [10, 'Алтынсай',     'Oltinsoy'],
            1008 => [10, 'Шаргун',       "Sharg'un"],
            1009 => [10, 'Узун',         'Uzun'],
            1010 => [10, 'Сариасия',     'Sariosiyo'],

            // Регион 11 — Сырдарьинская область
            1101 => [11, 'Гулистан',     'Guliston'],
            1102 => [11, 'Янгиер',       'Yangiyer'],
            1103 => [11, 'Сырдарья',     'Sirdaryo'],
            1104 => [11, 'Бахт',         'Baxt'],
            1105 => [11, 'Шараф-Рашидов','Sharaf Rashidov'],
            1106 => [11, 'Акалтын',      'Oqoltin'],
            1107 => [11, 'Мирзаабад',    'Mirzaobod'],
            1108 => [11, 'Сайхунабад',   'Sayxunobod'],
            1109 => [11, 'Хаваст',       'Xovos'],
            1110 => [11, 'Дустлик',      "Do'stlik"],

            // Регион 12 — Ферганская область
            1201 => [12, 'Фергана',      "Farg'ona"],
            1202 => [12, 'Маргилан',     "Marg'ilon"],
            1203 => [12, 'Коканд',       "Qo'qon"],
            1204 => [12, 'Кувасай',      'Quvasoy'],
            1205 => [12, 'Риштан',       'Rishton'],
            1206 => [12, 'Яйпан',        'Yaypan'],
            1207 => [12, 'Бешарик',      'Beshariq'],
            1208 => [12, 'Кува',         'Quva'],
            1209 => [12, 'Учкуприк',     "Uchko'prik"],
            1210 => [12, 'Тошлок',       'Toshloq'],

            // Регион 13 — Хорезмская область
            1301 => [13, 'Ургенч',       'Urganch'],
            1302 => [13, 'Хива',         'Xiva'],
            1303 => [13, 'Питняк',       'Pitnak'],
            1304 => [13, 'Шават',        'Shovot'],
            1305 => [13, 'Хазорасп',     'Xazorasp'],
            1306 => [13, 'Ханка',        'Xonqa'],
            1307 => [13, 'Гурлен',       'Gurlan'],
            1308 => [13, 'Богот',        "Bog'ot"],
            1309 => [13, 'Янгиарык',     'Yangiariq'],
            1310 => [13, 'Кошкупир',     "Qo'shko'pir"],

            // Регион 14 — Каракалпакстан
            1401 => [14, 'Нукус',        'Nukus'],
            1402 => [14, 'Турткуль',     "To'rtko'l"],
            1403 => [14, 'Беруни',       'Beruniy'],
            1404 => [14, 'Кунград',      "Qo'ng'irot"],
            1405 => [14, 'Муйнак',       "Mo'ynoq"],
            1406 => [14, 'Тахиаташ',     'Taxiatosh'],
            1407 => [14, 'Ходжейли',     "Xo'jayli"],
            1408 => [14, 'Чимбай',       'Chimboy'],
            1409 => [14, 'Караузяк',     "Qorao'zak"],
            1410 => [14, 'Шуманай',      'Shumanay'],
        ];

        $success_count = 0;
        $error_count = 0;
        $batch_size = 50;
        $batch = [];

        foreach ($cities as $id => [$region_id, $name_ru, $name_uz]) {
            $batch[] = [
                'id' => $id,
                'region_id' => $region_id,
                'name_ru' => $name_ru,
                'name_uz' => $name_uz,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($batch) >= $batch_size) {
                $this->insertBatch($batch, $success_count, $error_count);
                $batch = [];
            }
        }

        // Вставить оставшиеся записи
        if (!empty($batch)) {
            $this->insertBatch($batch, $success_count, $error_count);
        }

        echo "✅ Заполнена таблица cities: $success_count успешно, $error_count ошибок\n";
    }

    private function insertBatch(array $batch, int &$success_count, int &$error_count): void
    {
        try {
            DB::table('cities')->insert($batch);
            $success_count += count($batch);
        } catch (\Exception $e) {
            $error_count += count($batch);
            Log::error('Ошибка при вставке городов: ' . $e->getMessage());
            
            // Попробовать вставить по одному для отладки
            foreach ($batch as $city) {
                try {
                    DB::table('cities')->insert($city);
                    $success_count++;
                } catch (\Exception $single_error) {
                    $error_count++;
                    echo "❌ Ошибка при вставке города ID {$city['id']} ({$city['name_ru']}): " . $single_error->getMessage() . "\n";
                }
            }
        }
    }
}