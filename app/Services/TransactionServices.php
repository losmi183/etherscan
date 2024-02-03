<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Http;

// use Illuminate\Support\Collection;
// use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TransactionServices {

    /**
     * transactionsFetch - get transactions from api and save to database
     * 
     * @param array $params
     * 
     * @return array
     */
    public function transactionsFetch(array $params): \stdClass
    { 
        // Prepering parameters from request and config
        $apiKey = config('etherscan.apiKey');
        $apiUrl = config('etherscan.apiUrl');
        $address = $params['address'];
        $startblock = $params['startblock'] ? $params['startblock'] : '9000000';
        // $startblock = '10000000';
        $endblock = $params['endblock'] ? $params['endblock'] : 'latest';       

        $transactions = (new HttpServices)->get($apiKey, $apiUrl, $address, $startblock, $endblock);

        $result = (new TransactionRepository)->saveTransactions($transactions, $address);

        return $result;
    }

}
