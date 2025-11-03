<?php

namespace App\Traits;

trait CommonTrait
{
    public function SyncRatesAPI()
    {
        $accessKey = 'ada471d55c2f64e39f919687c4cf99b2';
        $base = 'AED';
        // API Endpoint (Replace with your actual API key)
        $apiUrl = "https://api.exchangeratesapi.io/v1/latest?access_key=".$accessKey."&base=".$base;

        // Fetch exchange rates
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);

        // Check if API response is valid
        if (!isset($data['rates']) || !is_array($data['rates'])) {
            die("Error fetching exchange rates.");
        }

        $result = []; // Initialize result array

        // Process currency exchange data
        foreach ($data['rates'] as $currency => $rate) {
            // $currency_value = round($rate, 6);

            $result[] = [
                'CURRENCY_NAME' => $currency,
                'rates' => $rate,
                'Cash Buy' => round((  1 / $rate), 6),
                'Currency Buy from' => round(round((  1 / $rate), 6)  - ( 0.000001 ), 6),
                'Currency Buy upto' => round(round((  1 / $rate), 6)  + ( 0.000001 ), 6),
                'Cash sell' => round((  1 / $rate), 6),
                'Cash sell from' => round(round((  1 / $rate), 6)  - ( 0.000001 ), 6),
                'Cash sell upto' => round(round((  1 / $rate), 6)  + ( 0.000001 ), 6),
            ];

        }

        // Prepare data for batch insert
        $insertData = [];
        
        $currencyNames = self::currencyMaster();
        foreach ($result as $item) {
            $insertData[] = [
            'base' => $base,
            'fetching_date' => now(),
            'rates_of_exchange_currency_code' => $item['CURRENCY_NAME'],
            'rates_of_exchange_currency_name' => array_key_exists($item['CURRENCY_NAME'], $currencyNames) ? $currencyNames[$item['CURRENCY_NAME']][0].', '.$currencyNames[$item['CURRENCY_NAME']][1] : '-',
            'rates_of_exchange_currency_rate' => $item['rates'],
            'cash_buy' => $item['Cash Buy'],
            'cash_buy_from' => $item['Currency Buy from'],
            'cash_buy_upto' => $item['Currency Buy upto'],
            'cash_sell' => $item['Cash sell'],
            'cash_sell_from' => $item['Cash sell from'],
            'cash_sell_upto' => $item['Cash sell upto'],
            'created_at' => now(),
            'updated_at' => now(),
            ];
        }

        // Insert data into rate_of_exchange_api table in chunks
        $chunks = array_chunk($insertData, 500);
        foreach ($chunks as $chunk) {
            DB::table('rate_of_exchange_api')->insert($chunk);
        }

        // Return successfully completed response
        return response()->json([
            'success' => true,   
            'message' => 'Exchange rates updated successfully.'
        ]);
    }
}
