<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('locations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $arrayCountries = array(
            "AF" => array('alpha2' => 'AF', 'name' => "Afghanistan",),
            "AL" => array('alpha2' => 'AL', "name" => "Albania"),
            "DZ" => array('alpha2' => 'DZ', "name" => "Algeria"),
            "AS" => array('alpha2' => 'AS', "name" => "American Samoa"),
            "AD" => array('alpha2' => 'AD', "name" => "Andorra"),
            "AO" => array('alpha2' => 'AO', "name" => "Angola"),
            "AI" => array('alpha2' => 'AI', "name" => "Anguilla"),
            "AQ" => array('alpha2' => 'AQ', "name" => "Antarctica"),
            "AR" => array('alpha2' => 'AR', "name" => "Argentina"),
            "AM" => array('alpha2' => 'AM', "name" => "Armenia"),
            "AU" => array('alpha2' => 'AU', "name" => "Australia"),
            "AT" => array('alpha2' => 'AT', "name" => "Austria"),
            "AZ" => array('alpha2' => 'AZ', "name" => "Azerbaijan"),
            "BS" => array('alpha2' => 'BS', "name" => "Bahamas"),
            "BH" => array('alpha2' => 'BH', "name" => "Bahrain"),
            "BD" => array('alpha2' => 'BD', "name" => "Bangladesh"),
            "BY" => array('alpha2' => 'BY', "name" => "Belarus"),
            "BE" => array('alpha2' => 'BE', 'name' => 'Belgium'),
            "BZ" => array('alpha2' => 'BZ', "name" => "Belize"),
            "BJ" => array('alpha2' => 'BJ', "name" => "Benin"),
            "BT" => array('alpha2' => 'BT', "name" => "Bhutan"),
            "BO" => array('alpha2' => 'BO', "name" => "Bolivia"),
            "BA" => array('alpha2' => 'BA', "name" => "Bosnia and Herzegovina"),
            "BW" => array('alpha2' => 'BW', "name" => "Botswana"),
            "BR" => array('alpha2' => 'BR', "name" => "Brazil"),
            "BG" => array('alpha2' => 'BG', "name" => "Bulgaria"),
            "BF" => array('alpha2' => 'BF', "name" => "Burkina Faso"),
            "BI" => array('alpha2' => 'BI', "name" => "Burundi"),
            "KH" => array('alpha2' => 'KH', "name" => "Cambodia"),
            "CM" => array('alpha2' => 'CM', "name" => "Cameroon"),
            "CA" => array('alpha2' => 'CA', "name" => "Canada"),
            "CV" => array('alpha2' => 'CV', "name" => "Cape Verde"),
            "KY" => array('alpha2' => 'KY', "name" => "Cayman Islands"),
            "CF" => array('alpha2' => 'CF', "name" => "Central African Republic"),
            "TD" => array('alpha2' => 'TD', "name" => "Chad"),
            "CL" => array('alpha2' => 'CL', "name" => "Chile"),
            "CN" => array('alpha2' => 'CN', "name" => "China"),
            "CO" => array('alpha2' => 'CO', "name" => "Colombia"),
            "CG" => array('alpha2' => 'CG', "name" => "Congo"),
            "CD" => array('alpha2' => 'CD', "name" => "The Democratic Republic of The Congo"),
            "CR" => array('alpha2' => 'CR', "name" => "Costa Rica"),
            "CI" => array('alpha2' => 'CI', "name" => "Cote D'ivoire"),
            "CW" => array('alpha2' => 'CW', "name" => "Curaçao"),
            "HR" => array('alpha2' => 'HR', "name" => "Croatia"),
            "CU" => array('alpha2' => 'CU', "name" => "Cuba"),
            "CY" => array('alpha2' => 'CY', "name" => "Cyprus"),
            "CZ" => array('alpha2' => 'CZ', "name" => "Czech Republic"),
            "DK" => array('alpha2' => 'DK', "name" => "Denmark"),
            "DJ" => array('alpha2' => 'DJ', "name" => "Djibouti"),
            "DM" => array('alpha2' => 'DM', "name" => "Dominica"),
            "DO" => array('alpha2' => 'DO', "name" => "Dominican Republic"),
            "EC" => array('alpha2' => 'EC', "name" => "Ecuador"),
            "EG" => array('alpha2' => 'EG', "name" => "Egypt"),
            "SV" => array('alpha2' => 'SV', "name" => "El Salvador"),
            "GQ" => array('alpha2' => 'GQ', "name" => "Equatorial Guinea"),
            "ER" => array('alpha2' => 'ER', "name" => "Eritrea"),
            "EE" => array('alpha2' => 'EE', "name" => "Estonia"),
            "ET" => array('alpha2' => 'ET', "name" => "Ethiopia"),
            "FJ" => array('alpha2' => 'FJ', "name" => "Fiji"),
            "FI" => array('alpha2' => 'FI', "name" => "Finland"),
            "FR" => array('alpha2' => 'FR', "name" => "France"),
            "GF" => array('alpha2' => 'GF', "name" => "French Guiana"),
            "PF" => array('alpha2' => 'PF', "name" => "French Polynesia"),
            "GA" => array('alpha2' => 'GA', "name" => "Gabon"),
            "GM" => array('alpha2' => 'GM', "name" => "Gambia"),
            "GE" => array('alpha2' => 'GE', "name" => "Georgia"),
            "DE" => array('alpha2' => 'DE', "name" => "Germany"),
            "GH" => array('alpha2' => 'GH', "name" => "Ghana"),
            "GI" => array('alpha2' => 'GI', "name" => "Gibraltar"),
            "GR" => array('alpha2' => 'GR', "name" => "Greece"),
            "GL" => array('alpha2' => 'GL', "name" => "Greenland"),
            "GD" => array('alpha2' => 'GD', "name" => "Grenada"),
            "GP" => array('alpha2' => 'GP', "name" => "Guadeloupe"),
            "GU" => array('alpha2' => 'GU', "name" => "Guam"),
            "GT" => array('alpha2' => 'GT', "name" => "Guatemala"),
            "GG" => array('alpha2' => 'GG', "name" => "Guernsey"),
            "GN" => array('alpha2' => 'GN', "name" => "Guinea"),
            "GW" => array('alpha2' => 'GW', "name" => "Guinea-bissau"),
            "GY" => array('alpha2' => 'GY', "name" => "Guyana"),
            "HT" => array('alpha2' => 'HT', "name" => "Haiti"),
            "HN" => array('alpha2' => 'HN', "name" => "Honduras"),
            "HK" => array('alpha2' => 'HK', "name" => "Hong Kong"),
            "HU" => array('alpha2' => 'HU', "name" => "Hungary"),
            "IS" => array('alpha2' => 'IS', "name" => "Iceland"),
            "IN" => array('alpha2' => 'IN', "name" => "India"),
            "ID" => array('alpha2' => 'ID', "name" => "Indonesia"),
            "IR" => array('alpha2' => 'IR', "name" => "Iran"),
            "IQ" => array('alpha2' => 'IQ', "name" => "Iraq"),
            "IE" => array('alpha2' => 'IE', "name" => "Ireland"),
            "IL" => array('alpha2' => 'IL', "name" => "Israel"),
            "IT" => array('alpha2' => 'IT', "name" => "Italy"),
            "JM" => array('alpha2' => 'JM', "name" => "Jamaica"),
            "JP" => array('alpha2' => 'JP', "name" => "Japan"),
            "JE" => array('alpha2' => 'JE', "name" => "Jersey"),
            "JO" => array('alpha2' => 'JO', "name" => "Jordan"),
            "KZ" => array('alpha2' => 'KZ', "name" => "Kazakhstan"),
            "KE" => array('alpha2' => 'KE', "name" => "Kenya"),
            "KI" => array('alpha2' => 'KI', "name" => "Kiribati"),
            "KP" => array('alpha2' => 'KP', "name" => "Democratic People's Republic of Korea"),
            "KR" => array('alpha2' => 'KR', "name" => "Republic of Korea"),
            "KW" => array('alpha2' => 'KW', "name" => "Kuwait"),
            "KG" => array('alpha2' => 'KG', "name" => "Kyrgyzstan"),
            "LA" => array('alpha2' => 'LA', "name" => "Laos Republic"),
            "LV" => array('alpha2' => 'LV', "name" => "Latvia"),
            "LB" => array('alpha2' => 'LB', "name" => "Lebanon"),
            "LS" => array('alpha2' => 'LS', "name" => "Lesotho"),
            "LR" => array('alpha2' => 'LR', "name" => "Liberia"),
            "LY" => array('alpha2' => 'LY', "name" => "Libya"),
            "LI" => array('alpha2' => 'LI', "name" => "Liechtenstein"),
            "LT" => array('alpha2' => 'LT', "name" => "Lithuania"),
            "LU" => array('alpha2' => 'LU', "name" => "Luxembourg"),
            "MO" => array('alpha2' => 'MO', "name" => "Macao"),
            "MK" => array('alpha2' => 'MK', "name" => "Macedonia"),
            "MG" => array('alpha2' => 'MG', "name" => "Madagascar"),
            "MW" => array('alpha2' => 'MW', "name" => "Malawi"),
            "MY" => array('alpha2' => 'MY', "name" => "Malaysia"),
            "MV" => array('alpha2' => 'MV', "name" => "Maldives"),
            "ML" => array('alpha2' => 'ML', "name" => "Mali"),
            "MT" => array('alpha2' => 'MT', "name" => "Malta"),
            "MQ" => array('alpha2' => 'MQ', "name" => "Martinique"),
            "MR" => array('alpha2' => 'MR', "name" => "Mauritania"),
            "MU" => array('alpha2' => 'MU', "name" => "Mauritius"),
            "YT" => array('alpha2' => 'YT', "name" => "Mayotte"),
            "MX" => array('alpha2' => 'MX', "name" => "Mexico"),
            "MD" => array('alpha2' => 'MD', "name" => "Moldova"),
            "MC" => array('alpha2' => 'MC', "name" => "Monaco"),
            "MN" => array('alpha2' => 'MN', "name" => "Mongolia"),
            "ME" => array('alpha2' => 'ME', "name" => "Montenegro"),
            "MS" => array('alpha2' => 'MS', "name" => "Montserrat"),
            "MA" => array('alpha2' => 'MA', "name" => "Morocco"),
            "MZ" => array('alpha2' => 'MZ', "name" => "Mozambique"),
            "MM" => array('alpha2' => 'MM', "name" => "Myanmar"),
            "NA" => array('alpha2' => 'NA', "name" => "Namibia"),
            "NR" => array('alpha2' => 'NR', "name" => "Nauru"),
            "NP" => array('alpha2' => 'NP', "name" => "Nepal"),
            "NL" => array('alpha2' => 'NL', "name" => "Netherlands"),
            "NC" => array('alpha2' => 'NC', "name" => "New Caledonia"),
            "NZ" => array('alpha2' => 'NZ', "name" => "New Zealand"),
            "NI" => array('alpha2' => 'NI', "name" => "Nicaragua"),
            "NE" => array('alpha2' => 'NE', "name" => "Niger"),
            "NG" => array('alpha2' => 'NG', "name" => "Nigeria"),
            "NU" => array('alpha2' => 'NU', "name" => "Niue"),
            "NF" => array('alpha2' => 'NF', "name" => "Norfolk Island"),
            "NO" => array('alpha2' => 'NO', "name" => "Norway"),
            "OM" => array('alpha2' => 'OM', "name" => "Oman"),
            "PK" => array('alpha2' => 'PK', "name" => "Pakistan"),
            "PW" => array('alpha2' => 'PW', "name" => "Palau"),
            "PS" => array('alpha2' => 'PS', "name" => "Palestinia"),
            "PA" => array('alpha2' => 'PA', "name" => "Panama"),
            "PG" => array('alpha2' => 'PG', "name" => "Papua New Guinea"),
            "PY" => array('alpha2' => 'PY', "name" => "Paraguay"),
            "PE" => array('alpha2' => 'PE', "name" => "Peru"),
            "PH" => array('alpha2' => 'PH', "name" => "Philippines"),
            "PN" => array('alpha2' => 'PN', "name" => "Pitcairn"),
            "PL" => array('alpha2' => 'PL', "name" => "Poland"),
            "PT" => array('alpha2' => 'PT', "name" => "Portugal"),
            "PR" => array('alpha2' => 'PR', "name" => "Puerto Rico"),
            "QA" => array('alpha2' => 'QA', "name" => "Qatar"),
            "RE" => array('alpha2' => 'RE', "name" => "Reunion"),
            "RO" => array('alpha2' => 'RO', "name" => "Romania"),
            "RU" => array('alpha2' => 'RU', "name" => "Russia"),
            "RW" => array('alpha2' => 'RW', "name" => "Rwanda"),
            "WS" => array('alpha2' => 'WS', "name" => "Samoa"),
            "SM" => array('alpha2' => 'SM', "name" => "San Marino"),
            "ST" => array('alpha2' => 'ST', "name" => "Sao Tome and Principe"),
            "SA" => array('alpha2' => 'SA', "name" => "Saudi Arabia"),
            "SN" => array('alpha2' => 'SN', "name" => "Senegal"),
            "RS" => array('alpha2' => 'RS', "name" => "Serbia"),
            "SC" => array('alpha2' => 'SC', "name" => "Seychelles"),
            "SL" => array('alpha2' => 'SL', "name" => "Sierra Leone"),
            "SG" => array('alpha2' => 'SG', "name" => "Singapore"),
            "SK" => array('alpha2' => 'SK', "name" => "Slovakia"),
            "SI" => array('alpha2' => 'SI', "name" => "Slovenia"),
            "SO" => array('alpha2' => 'SO', "name" => "Somalia"),
            "ZA" => array('alpha2' => 'ZA', "name" => "South Africa"),
            "SS" => array('alpha2' => 'SS', "name" => "South Sudan"),
            "ES" => array('alpha2' => 'ES', "name" => "Spain"),
            "LK" => array('alpha2' => 'LK', "name" => "Sri Lanka"),
            "SD" => array('alpha2' => 'SD', "name" => "Sudan"),
            "SR" => array('alpha2' => 'SR', "name" => "Suriname"),
            "SZ" => array('alpha2' => 'SZ', "name" => "Swaziland"),
            "SE" => array('alpha2' => 'SE', "name" => "Sweden"),
            "CH" => array('alpha2' => 'CH', "name" => "Switzerland"),
            "SY" => array('alpha2' => 'SY', "name" => "Syrian Arab Republic"),
            "TW" => array('alpha2' => 'TW', "name" => "Taiwan"),
            "TJ" => array('alpha2' => 'TJ', "name" => "Tajikistan"),
            "TZ" => array('alpha2' => 'TZ', "name" => "Tanzania"),
            "TH" => array('alpha2' => 'TH', "name" => "Thailand"),
            "TL" => array('alpha2' => 'TL', "name" => "Timor-leste"),
            "TG" => array('alpha2' => 'TG', "name" => "Togo"),
            "TO" => array('alpha2' => 'TO', "name" => "Tonga"),
            "TN" => array('alpha2' => 'TN', "name" => "Tunisia"),
            "TR" => array('alpha2' => 'TR', "name" => "Turkey"),
            "TM" => array('alpha2' => 'TM', "name" => "Turkmenistan"),
            "TV" => array('alpha2' => 'TV', "name" => "Tuvalu"),
            "UG" => array('alpha2' => 'UG', "name" => "Uganda"),
            "UA" => array('alpha2' => 'UA', "name" => "Ukraine"),
            "AE" => array('alpha2' => 'AE', "name" => "United Arab Emirates"),
            "GB" => array('alpha2' => 'GB', "name" => "United Kingdom"),
            "US" => array('alpha2' => 'US', "name" => "United States"),
            "UY" => array('alpha2' => 'UY', "name" => "Uruguay"),
            "UZ" => array('alpha2' => 'UZ', "name" => "Uzbekistan"),
            "VU" => array('alpha2' => 'VU', "name" => "Vanuatu"),
            "VE" => array('alpha2' => 'VE', "name" => "Venezuela"),
            "VN" => array('alpha2' => 'VN', "name" => "Vietnam"),
            "EH" => array('alpha2' => 'EH', "name" => "Western Sahara"),
            "YE" => array('alpha2' => 'YE', "name" => "Yemen"),
            "ZM" => array('alpha2' => 'ZM', "name" => "Zambia"),
            "ZW" => array('alpha2' => 'ZW', "name" => "Zimbabwe")
        );


        $locations = [];

        foreach ($arrayCountries as $country) {
            $locations[] = [
                'country_code' => $country['alpha2'],
                'country_name' => $country['name']
            ];
        }

        DB::table('locations')->insert($locations);
    }
}