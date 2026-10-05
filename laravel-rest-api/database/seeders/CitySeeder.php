<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // Budapest (County ID 1)
            ['name' => 'Budapest', 'zip_code' => '1011', 'id_county' => 1, 'population' => 1686000],

            // Bács-Kiskun (County ID 2)
            ['name' => 'Kecskemét', 'zip_code' => '6000', 'id_county' => 2, 'population' => 109600],
            ['name' => 'Baja', 'zip_code' => '6500', 'id_county' => 2, 'population' => 34000],

            // Baranya (County ID 3)
            ['name' => 'Pécs', 'zip_code' => '7621', 'id_county' => 3, 'population' => 140000],
            ['name' => 'Mohács', 'zip_code' => '7700', 'id_county' => 3, 'population' => 17000],

            // Békés (County ID 4)
            ['name' => 'Békéscsaba', 'zip_code' => '5600', 'id_county' => 4, 'population' => 58000],
            ['name' => 'Gyula', 'zip_code' => '5700', 'id_county' => 4, 'population' => 28000],

            // Borsod-Abaúj-Zemplén (County ID 5)
            ['name' => 'Miskolc', 'zip_code' => '3500', 'id_county' => 5, 'population' => 150000],
            ['name' => 'Kazincbarcika', 'zip_code' => '3700', 'id_county' => 5, 'population' => 25000],

            // Csongrád-Csanád (County ID 6)
            ['name' => 'Szeged', 'zip_code' => '6720', 'id_county' => 6, 'population' => 159000],
            ['name' => 'Hódmezővásárhely', 'zip_code' => '6800', 'id_county' => 6, 'population' => 43000],

            // Fejér (County ID 7)
            ['name' => 'Székesfehérvár', 'zip_code' => '8000', 'id_county' => 7, 'population' => 95000],
            ['name' => 'Dunaújváros', 'zip_code' => '2400', 'id_county' => 7, 'population' => 42000],

            // Győr-Moson-Sopron (County ID 8)
            ['name' => 'Győr', 'zip_code' => '9021', 'id_county' => 8, 'population' => 132000],
            ['name' => 'Sopron', 'zip_code' => '9400', 'id_county' => 8, 'population' => 62000],

            // Hajdú-Bihar (County ID 9)
            ['name' => 'Debrecen', 'zip_code' => '4024', 'id_county' => 9, 'population' => 200000],
            ['name' => 'Hajdúszoboszló', 'zip_code' => '4200', 'id_county' => 9, 'population' => 23000],

            // Heves (County ID 10)
            ['name' => 'Eger', 'zip_code' => '3300', 'id_county' => 10, 'population' => 51000],

            // Jász-Nagykun-Szolnok (County ID 11)
            ['name' => 'Szolnok', 'zip_code' => '5000', 'id_county' => 11, 'population' => 69000],

            // Komárom-Esztergom (County ID 12)
            ['name' => 'Tatabánya', 'zip_code' => '2800', 'id_county' => 12, 'population' => 65000],
            ['name' => 'Esztergom', 'zip_code' => '2500', 'id_county' => 12, 'population' => 28000],

            // Nógrád (County ID 13)
            ['name' => 'Salgótarján', 'zip_code' => '3100', 'id_county' => 13, 'population' => 32000],

            // Pest (County ID 14)
            ['name' => 'Érd', 'zip_code' => '2030', 'id_county' => 14, 'population' => 70000],
            ['name' => 'Dunakeszi', 'zip_code' => '2120', 'id_county' => 14, 'population' => 43000],

            // Somogy (County ID 15)
            ['name' => 'Kaposvár', 'zip_code' => '7400', 'id_county' => 15, 'population' => 60000],
            ['name' => 'Siófok', 'zip_code' => '8600', 'id_county' => 15, 'population' => 25000],

            // Szabolcs-Szatmár-Bereg (County ID 16)
            ['name' => 'Nyíregyháza', 'zip_code' => '4400', 'id_county' => 16, 'population' => 116000],

            // Tolna (County ID 17)
            ['name' => 'Szekszárd', 'zip_code' => '7100', 'id_county' => 17, 'population' => 30000],

            // Vas (County ID 18)
            ['name' => 'Szombathely', 'zip_code' => '9700', 'id_county' => 18, 'population' => 78000],

            // Veszprém (County ID 19)
            ['name' => 'Veszprém', 'zip_code' => '8200', 'id_county' => 19, 'population' => 58000],
            ['name' => 'Pápa', 'zip_code' => '8500', 'id_county' => 19, 'population' => 29000],

            // Zala (County ID 20)
            ['name' => 'Zalaegerszeg', 'zip_code' => '8900', 'id_county' => 20, 'population' => 56000],
            ['name' => 'Nagykanizsa', 'zip_code' => '8800', 'id_county' => 20, 'population' => 45000],
        ];

        DB::table('cities')->insert($cities);
    }
}