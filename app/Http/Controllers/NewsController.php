<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class NewsController extends Controller
{
    public function getNews(Request $request)
    {
        try {
            $apiKey = env('NEWS_API_KEY');
            $query = $request->input('query', 'tehnologie');

            $response = Http::get('https://newsapi.org/v2/everything', [
                'q' => $query,
                'apiKey' => $apiKey,
                'language' => 'ro',
                'pageSize' => 5
            ]);

            if ($response->failed()) {
                throw new Exception('Eroare la API-ul NewsAPI.');
            }

            $data = $response->json();

            if (!isset($data['articles'])) {
                throw new Exception('Datele nu au fost returnate corect.');
            }

            return response()->json([
                'articles' => array_slice($data['articles'], 0, 5)
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
