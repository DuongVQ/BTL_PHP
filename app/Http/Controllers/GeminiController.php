<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeminiController extends Controller
{
    public function chat(Request $request)
    {
        $prompt = $request->input('prompt');
        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=$apiKey";
        $response = Http::post($url, [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        return response()->json($response->json());
    }
}