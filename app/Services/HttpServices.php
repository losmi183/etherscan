<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;


class HttpServices {

    /**
     * Fetch transactionf from apiUrl with api key and other params
     * wrapper over guzzle http client     * 
     * Return array of transactions or abort with default 400 status code
     * 
     * @param string $apiKey
     * @param string $apiUrl
     * @param string $address
     * @param int $startblock
     * @param mixed $endblock
     * 
     * @return array
     */
    public function get(string $apiKey, string $apiUrl, string $address, int $startblock, $endblock): array
    { 

        try {
            $response = Http::get($apiUrl, [
                'apikey' => $apiKey,
                'address' => $address,
                'startblock' => $startblock,
                'endblock' => $endblock,
                // Const params for API
                'module' => config('etherscan.module'),
                'action' => config('etherscan.action'),
            ]);
    
            // Check status code
            if ($response->successful()) {
                return $response->json(); // convert to array
            } else {
                // abort on error
                Log::error(json_encode($response->status()).' - Failed to fetch data from Etherscan API.');
                // abort($response->status(), 'Failed to fetch data from Etherscan API.');
                return [
                    'status' => json_encode($response->status()),
                    'message' => 'Failed to fetch data from Etherscan API.',
                ];
            }
        } 
        catch (RequestException $e) {
            if ($e->getCode() == 28) {
                Log::error('Error: Timeout was reached: ' . $e->getMessage());
                return [
                    'status' => json_encode($e->getMessage()),
                    'message' => 'Error: Timeout was reached:',
                ];
            } else {
                Log::error('Error: Timeout was reached: ' . $e->getMessage());
                return [
                    'status' => json_encode($e->getMessage()),
                    'message' => 'Error',
                ];  
            }
        }
        catch (\Throwable $th) {
            Log::error('Error: Timeout was reached: ' . $th->getMessage());
            return [
                'status' => json_encode($th->getMessage()),
                'message' => 'Error: Timeout was reached:',
            ];
        }
    }
}
