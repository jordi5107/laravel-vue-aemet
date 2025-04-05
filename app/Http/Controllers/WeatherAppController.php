<?php

namespace App\Http\Controllers;

use App\Models\Township;
use GuzzleHttp\Client;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class WeatherAppController extends Controller
{
    /**
     * Display the weather page.
     */
    public function index(Request $request): Response
    {

        $townships = Township::all();

        return Inertia::render('Index', [
                'townships' => $townships,
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
    }

    /**
     * Get township weather.
     */
    public function searchTownshipForecast($townshipCode, Request $request)
    {
        $client = new Client();

        try {   
            $response = $client->request('GET', env('AEMET_API_URL') . '/prediccion/especifica/municipio/diaria/' . $townshipCode, [
                'headers' => [
                    'api_key' => env('AEMET_API_KEY')
                ]
            ]);
            
            $data = json_decode($response->getBody()->getContents(), true);
            $urlData = $data['datos'];

            if (!empty($urlData)) {
                try {
                    $forecastResponse = $client->request('GET', $urlData);
                    $forecastData = $forecastResponse->getBody()->getContents();

                    $forecastData = mb_convert_encoding($forecastData, 'UTF-8', 'UTF-8');
                    $forecastData = json_decode($forecastData, true);

                    return response()->json([
                        'forecast' => $forecastData[0]['prediccion']['dia'],
                        'townshipCode' => $townshipCode
                    ]);
                    
                } catch (\Exception $e) {
                    return response()->json([
                        'error' => 'Unable to fetch forecast data: ' . $e->getMessage(),
                        'townshipCode' => $townshipCode
                    ]);
                }
            } else {
               return response()->json([
                    'error' => 'No data found for the given township code.',
                    'townshipCode' => $townshipCode
                ]);
            }

        } catch (\Exception $e) {
            return Inertia::render('TownshipForecast', [
                'error' => 'Unable to fetch forecast data: ' . $e->getMessage(),
                'townshipCode' => $townshipCode
            ]);
        }
    }
}
