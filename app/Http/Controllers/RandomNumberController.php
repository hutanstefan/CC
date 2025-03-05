<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class RandomNumberController extends Controller
{
    public function getRandomNumber(Request $request)
    {
        try {
            $apiKey = env('RANDOM_ORG_API_KEY');

            $min = $request->input('min', 1);
            $max = $request->input('max', 100);

            if ($min >= $max) {
                throw new Exception('Min trebuie să fie mai mic decât Max.');
            }

            $response = Http::post('https://api.random.org/json-rpc/4/invoke', [
                'jsonrpc' => '2.0',
                'method' => 'generateIntegers',
                'params' => [
                    'apiKey' => $apiKey,
                    'n' => 1,
                    'min' => (int) $min,
                    'max' => (int) $max,
                    'replacement' => true
                ],
                'id' => 42
            ]);

            if ($response->failed()) {
                throw new Exception('Eroare la conectarea cu API-ul Random.org.');
            }

            $data = $response->json();

            if (!isset($data['result']['random']['data'][0])) {
                throw new Exception('Datele nu au fost returnate corect de API.');
            }

            $randomNumber = $data['result']['random']['data'][0];

            return response()->json(['randomNumber' => $randomNumber]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
