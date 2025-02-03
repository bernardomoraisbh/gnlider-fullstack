<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brazil = Country::where('code', '=', 'BRA')->first();

        $states = [
            [
                'name' => 'Acre',
                'abbreviation' => 'AC',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Alagoas',
                'abbreviation' => 'AL',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Amapá',
                'abbreviation' => 'AP',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Amazonas',
                'abbreviation' => 'AM',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Bahia',
                'abbreviation' => 'BA',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Ceará',
                'abbreviation' => 'CE',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Distrito Federal',
                'abbreviation' => 'DF',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Espírito Santo',
                'abbreviation' => 'ES',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Goiás',
                'abbreviation' => 'GO',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Maranhão',
                'abbreviation' => 'MA',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Mato Grosso',
                'abbreviation' => 'MT',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Mato Grosso do Sul',
                'abbreviation' => 'MS',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Minas Gerais',
                'abbreviation' => 'MG',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Pará',
                'abbreviation' => 'PA',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Paraíba',
                'abbreviation' => 'PB',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Paraná',
                'abbreviation' => 'PR',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Pernambuco',
                'abbreviation' => 'PE',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Piauí',
                'abbreviation' => 'PI',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Rio de Janeiro',
                'abbreviation' => 'RJ',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Rio Grande do Norte',
                'abbreviation' => 'RN',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Rio Grande do Sul',
                'abbreviation' => 'RS',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Rondônia',
                'abbreviation' => 'RO',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Roraima',
                'abbreviation' => 'RR',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Santa Catarina',
                'abbreviation' => 'SC',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'São Paulo',
                'abbreviation' => 'SP',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Sergipe',
                'abbreviation' => 'SE',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
            [
                'name' => 'Tocantins',
                'abbreviation' => 'TO',
                'phone_prefix' => '',
                'country_id' => $brazil->id
            ],
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
