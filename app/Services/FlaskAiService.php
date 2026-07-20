<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class FlaskAiService
{
    /**
     * Base URL for the Flask AI backend service.
     */
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.flask.url', 'http://127.0.0.1:5000'), '/');
    }

    /**
     * Request personalized diet recommendations from the Flask AI backend.
     *
     * @param int $kaloriMasuk Total calories consumed today
     * @param int $kaloriTerbakar Total calories burned today
     * @param int $targetDefisit Desired calorie deficit target
     * @return string Recommendation message from AI model or graceful fallback
     */
    public function getDietRecommendation(int $kaloriMasuk, int $kaloriTerbakar, int $targetDefisit = 500): string
    {
        $endpoint = $this->baseUrl . '/saran-ai';

        try {
            $response = Http::timeout(10)->post($endpoint, [
                'kalori_masuk' => $kaloriMasuk,
                'kalori_terbakar' => $kaloriTerbakar,
                'target_defisit' => $targetDefisit,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['saran']) && !empty($data['saran'])) {
                    return $data['saran'];
                }
            }

            Log::warning('Flask AI Service response error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return $this->getFallbackRecommendation($kaloriMasuk, $kaloriTerbakar, $targetDefisit, 'Layanan AI sedang tidak tersedia atau kredensial API belum diatur.');
        } catch (Throwable $e) {
            Log::error('Flask AI Service connection failed', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage(),
            ]);

            return $this->getFallbackRecommendation(
                $kaloriMasuk,
                $kaloriTerbakar,
                $targetDefisit,
                'Gagal terhubung ke layanan Flask AI. Pastikan service Python Flask berjalan dan memiliki kredensial API valid.'
            );
        }
    }

    /**
     * Fallback calculation and recommendation when AI service is unavailable.
     */
    protected function getFallbackRecommendation(int $kaloriMasuk, int $kaloriTerbakar, int $targetDefisit, string $note): string
    {
        $netDeficit = $kaloriMasuk - $kaloriTerbakar;
        $advice = "";

        if ($netDeficit > 0) {
            $advice = "Hari ini Anda mengalami surplus kalori sebesar {$netDeficit} kkal. Pertimbangkan untuk berolahraga ringan selama 30 menit atau mengonsumsi makanan rendah kalori.";
        } elseif ($netDeficit < 0) {
            $absDeficit = abs($netDeficit);
            $advice = "Kerja bagus! Anda mengalami defisit kalori sebesar {$absDeficit} kkal. Jaga asupan nutrisi tetap seimbang.";
        } else {
            $advice = "Asupan dan pembakaran kalori Anda seimbang hari ini. Pertahankan gaya hidup sehat dan konsisten.";
        }

        return "{$advice}\n\n(Catatan Sistem: {$note})";
    }
}
