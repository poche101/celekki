<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCenter;

class ServiceCenterSeeder extends Seeder
{
    public function run(): void
    {
        $list = [
            // GREAT GRACE PCF
            ['name' => 'LEKKI CHURCH SERVICE CENTRE', 'address' => 'LOVEWORLD ARENA LEKKI, OFF LEKKI -EPE EXPRESSWAY', 'pastor_in_charge' => 'PASTOR GRACE IBHAKHOMU', 'phone_number' => '8034777675', 'lat' => 6.4490, 'lng' => 3.4723],
            ['name' => 'FEMI OKUNNU 1 SERVICE CENTER', 'address' => 'NO. 2 FEMI OKUNNU ROAD, OPPOSITE FEMI OKUNNU PHASE 3 GATE, OSAPA LONDON', 'pastor_in_charge' => 'SISTER BLESSINGJOY UDOSEN', 'phone_number' => '8068067298', 'lat' => 6.4452, 'lng' => 3.5042],
            ['name' => 'LEKKI PHASE 1 SERVICE CENTRE', 'address' => 'LEKKI PHASE 1', 'pastor_in_charge' => 'SISTER OLA TAIWO', 'phone_number' => '8060068103', 'lat' => 6.4480, 'lng' => 3.4650],
            ['name' => 'GRACE ADVANTAGE SERVICE CENTRE', 'address' => 'LEKKI', 'pastor_in_charge' => 'SISTER CHRISTABEL', 'phone_number' => '', 'lat' => 6.4500, 'lng' => 3.4700],
            ['name' => 'SEAGATE SERVICE CENTER', 'address' => 'SEAGATE ESTATE', 'pastor_in_charge' => 'DEACON ALEX OLALEYE', 'phone_number' => '8070311632', 'lat' => 6.4350, 'lng' => 3.5000],
            ['name' => 'OLOGOLO SERVICE CENTRE', 'address' => 'MAYEIGUN PALACE OPP CATHOLIC CHURCH, OLOGOLO', 'pastor_in_charge' => 'BROTHER MAC ASORE', 'phone_number' => '', 'lat' => 6.4420, 'lng' => 3.5150],

            // GRACE FLOURISHING
            ['name' => 'ILASAN SERVICE CENTRE (FLOURISHING PCF SERVICE CENTRE 1)', 'address' => 'NO. 27a YEMI ADETAYO STRRET, ILASAN', 'pastor_in_charge' => 'SISTER SANDRA BEKEH', 'phone_number' => '7061066430', 'lat' => 6.4410, 'lng' => 3.4880],
            ['name' => 'LAKOWE SERVICE CENTRE (FLOURISHING PCF SERVICE CENTRE 2)', 'address' => 'LAKOWE', 'pastor_in_charge' => 'BROTHER JOSHUA AVRUAPERE', 'phone_number' => '9035149011', 'lat' => 6.4800, 'lng' => 3.7500],

            // GRACE DYNAMIC TRAILBLAZERS
            ['name' => 'EROS HOTEL SERVICE CENTER, JAKANDE', 'address' => 'EROS HOTEL, PLATINUM WAY–JAKANDE FIRST GATE', 'pastor_in_charge' => 'DEACONESS TEJIRI EMMANUEL', 'phone_number' => '8105205023', 'lat' => 6.4390, 'lng' => 3.4920],

            // STRATEGIC PROFESSIONALS
            ['name' => 'ASP RADIANCE', 'address' => 'LEKKI', 'pastor_in_charge' => 'SISTER STEPHANIE OFORKA', 'phone_number' => '', 'lat' => 6.4480, 'lng' => 3.4650],
            ['name' => 'ASP LIGHT SERVICE CENTRE, ORCHID ROAD', 'address' => 'STREET OFF FREEDOM WAY, LEKKI PHASE 1', 'pastor_in_charge' => 'DEACONESS MARY YARHERE', 'phone_number' => '8033122161', 'lat' => 6.4485, 'lng' => 3.4670],
            ['name' => 'ASP LUMINARIES', 'address' => 'LEKKI', 'pastor_in_charge' => 'DEACON FEMI OMOTAYE', 'phone_number' => '7074702451', 'lat' => 6.4480, 'lng' => 3.4650],

            // HAVEN OF GRACE FELLOWSHIP
            ['name' => 'HAVEN OF GRACE SERVICE CENTRE 1', 'address' => 'Huston Hotel, Osapa London', 'pastor_in_charge' => 'BROTHER EFE NAKPODIA', 'phone_number' => '8096655100', 'lat' => 6.4460, 'lng' => 3.5060],
            ['name' => 'AJIRAN SERVICE CENTRE (HAVEN OF GRACE SERVICE CENTRE 2)', 'address' => 'AJIRAN', 'pastor_in_charge' => '', 'phone_number' => '', 'lat' => 6.4400, 'lng' => 3.5000],

            // HOUSE OF GRACE FELLOWSHIP
            ['name' => 'THE BUNKER, LEKKI PHASE 1 SERVICE CENTER (HOUSE OF GRACE SERVICE CENTRE 1)', 'address' => 'THE BUNKER, LEKKI PHASE 1', 'pastor_in_charge' => 'BROTHER CHINENYE UDEH', 'phone_number' => '8025240247', 'lat' => 6.4470, 'lng' => 3.4630],
            ['name' => 'HOUSE OF GRACE CENTRE 2 (JAKANDE)', 'address' => 'JAKANDE', 'pastor_in_charge' => 'BROTHER COMMISSIONER CHIEDEBE', 'phone_number' => '', 'lat' => 6.4380, 'lng' => 3.4910],

            // LAMBANO EXCEL
            ['name' => 'IKOTA SERVICE CENTRE (EXCEL PCF SERVICE CENTRE 1)', 'address' => 'IKOTA', 'pastor_in_charge' => 'SISTER CASSANDRA STEPHEN-BRAI', 'phone_number' => '8063884028', 'lat' => 6.4650, 'lng' => 3.5300],
            ['name' => 'JAKANDE SERVICE CENTRE (EXCEL PCF SERVICE CENTRE 3)', 'address' => 'JAKANDE', 'pastor_in_charge' => 'BROTHER GODWIN ELUWA', 'phone_number' => '', 'lat' => 6.4380, 'lng' => 3.4910],

            // LAMBANO DUNAMIS
            ['name' => 'BAMBOO SERVICE CENTRE', 'address' => 'LEKKI', 'pastor_in_charge' => 'BROTHER STEPHEN BRAI', 'phone_number' => '7013659391', 'lat' => 6.4500, 'lng' => 3.4700],

            // LAMBANO DOMINION
            ['name' => 'IKATE SERVICE CENTRE (DOMINION PCF SERVICE CENTRE 1)', 'address' => 'IKATE', 'pastor_in_charge' => 'BROTHER GEORGE AGABI', 'phone_number' => '', 'lat' => 6.4350, 'lng' => 3.4850],
            ['name' => 'OKUN MOPOL SERVICE CENTRE (DOMINION PCF SERVICE CENTRE 2)', 'address' => 'OKUN MOPOL', 'pastor_in_charge' => 'BROTHER ONAH ONUWA', 'phone_number' => '9050929148', 'lat' => 6.4600, 'lng' => 3.5500],
            ['name' => 'OKUN AJAH SERVICE CENTRE (DOMINION PCF SERVICE CENTRE 3)', 'address' => 'OKUN AJAH', 'pastor_in_charge' => 'SISTER RHODA BAGAI', 'phone_number' => '', 'lat' => 6.4600, 'lng' => 3.5600],
            ['name' => 'ABOKI ESTATE SERVICE CENTR (DOMINION PCF SERVICE CENTRE 4)', 'address' => 'ABOKI ESTATE', 'pastor_in_charge' => '', 'phone_number' => '', 'lat' => 6.4630, 'lng' => 3.5680],
            ['name' => 'NEW ROAD SERVICE CENTRE (DOMINION PCF SERVICE CENTRE 5)', 'address' => 'NEW ROAD', 'pastor_in_charge' => 'BROTHER DANIEL', 'phone_number' => '', 'lat' => 6.4600, 'lng' => 3.5400],
            ['name' => 'BABALOLA SERVICE CENTRE (DOMINION PCF SERVICE CENTRE 6)', 'address' => 'BABALOLA', 'pastor_in_charge' => 'BROTHER ALEX NKOR', 'phone_number' => '', 'lat' => 6.4600, 'lng' => 3.5700],

            // LAMBANO NOBLE
            ['name' => 'OWODE SERVICE CENTRE', 'address' => 'OWODE', 'pastor_in_charge' => 'BROTHER SIMON UGWOKE', 'phone_number' => '7030846421', 'lat' => 6.4700, 'lng' => 3.5800],
            ['name' => 'LAMBANO NOBLE SERVICE CENTRES 2', 'address' => 'PLOT 48 MATANMI STREET ORILE MAROKO, MOBIL ROAD EXTENSION', 'pastor_in_charge' => 'SISTER GIFTED ANIETIE', 'phone_number' => '8140236311', 'lat' => 6.4320, 'lng' => 3.4500],

            // EMERALD FELLOWSHIP
            ['name' => 'EMERALD DUNAMIS SERVICE CENTRE, ABOKI JUNCTION', 'address' => 'ABOKI JUNCTION ILAJE, AJAH', 'pastor_in_charge' => 'BROTHER ANTHONY SAMUEL', 'phone_number' => '', 'lat' => 6.4633, 'lng' => 3.5689],
            ['name' => 'THE KINGDOM SERVICE CENTRE, EMERALD OASIS', 'address' => 'MOBA ROAD, AJAH', 'pastor_in_charge' => 'BROTHER ISREAL LOVE', 'phone_number' => '', 'lat' => 6.4650, 'lng' => 3.5750],
            ['name' => 'AMAZING LOVE SERVICE CENTRE, EMERALD CHARISMA SERVICE', 'address' => 'JAKANDE FIRST GATE, JAKANDE', 'pastor_in_charge' => 'BROTHER GREAT EVANS', 'phone_number' => '', 'lat' => 6.4380, 'lng' => 3.4910],

            // ACE PROFESSIONAL FELLOWSHIP
            ['name' => 'VICTORIA ISLAND (ACE PROFESSIONALS SERVICE CENTRE 1)', 'address' => 'VICTORIA CROWN PLAZA HOTEL 292B AJOSE ADEOGUN STREET, VICTORIA ISLAND', 'pastor_in_charge' => 'PASTOR CHINYERE DON-OKHOUFU', 'phone_number' => '8137343292', 'lat' => 6.4281, 'lng' => 3.4215],

            // PEARL FELLOWSHIP
            ['name' => 'PEARL FELLOWSHIP SERVICE CENTRE 1 (Golden Park Estate)', 'address' => 'GOLDEN PARK ESTATE', 'pastor_in_charge' => 'DEACONESS BIODUN DUZE', 'phone_number' => '8057710300', 'lat' => 6.4700, 'lng' => 3.5900],
            ['name' => 'PEARL FELLOWSHIP SERVICE CENTRE 2 (Madam Theresa Street, Unity Estate, Badore)', 'address' => 'UNITY ESTATE, BADORE', 'pastor_in_charge' => 'SISTER GEORGINA OYELUDE', 'phone_number' => '8152380863', 'lat' => 6.4800, 'lng' => 3.6000],
            ['name' => 'PEARL FELLOWSHIP SERVICE CENTRE 5 (Oniru Centre)', 'address' => 'ONIRU', 'pastor_in_charge' => 'SISTER CHIOMA EZECHUKWU', 'phone_number' => '8038501250', 'lat' => 6.4350, 'lng' => 3.4450],

            // HAVEN OF LOVE / PROLIFIC SUNRISE
            ['name' => 'HAVEN OF LOVE', 'address' => 'TRAVEL LODGE HOTEL, IKOTA', 'pastor_in_charge' => 'SISTER AKHERE AGONI', 'phone_number' => '07067307573', 'lat' => 6.4650, 'lng' => 3.5300],
            ['name' => 'PROLIFIC SUNRISE MISSION (AGUNGI)', 'address' => 'AGUNGI', 'pastor_in_charge' => 'BROTHER BEN JOSHUA', 'phone_number' => '8165032580', 'lat' => 6.4480, 'lng' => 3.5180],
        ];

        foreach ($list as $item) {
            ServiceCenter::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}
