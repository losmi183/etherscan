<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Support\Facades\Http;
use App\Repositories\TransactionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

// use Illuminate\Support\Collection;
// use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TransactionServices {

    /**
     * @var TransactionRepository
     */
    protected TransactionRepository $transactionRepository;
    /**
     * @var HttpServices
     */
    protected HttpServices $httpServices;


    /**
     * @param TransactionRepository $transactionRepository
     * @param HttpServices $httpServices
     */
    public function __construct(TransactionRepository $transactionRepository, HttpServices $httpServices)
    {
        $this->transactionRepository = $transactionRepository;
        $this->httpServices = $httpServices;
    }

    /**
     * transactionsFetch - get transactions from api and save to database
     * 
     * @param array $params
     * 
     * @return array
     */
    public function transactionsFetch(): array
    { 
        $this->transactionRepository->truncateTransactions();

        // Getting address from DB because of simplicity
        $wallet = Wallet::first();
        $address = $wallet->address;
        $startblock = config('etherscan.startblock');
        $endblock = config('etherscan.endblock');

        // Prepering parameters from request and config
        $apiKey = config('etherscan.apiKey');
        $apiUrl = config('etherscan.apiUrl');
        // $address = $params['address'];
        // $startblock = $params['startblock'] ? $params['startblock'] : '9000000';
        // $startblock = '10000000';
        // $endblock = $params['endblock'] ? $params['endblock'] : 'latest';       

        $transactions = $this->httpServices->get($apiKey, $apiUrl, $address, $startblock, $endblock);

        // If new transactions fetched, first delete all old transactions
        

        $result = $this->transactionRepository->saveTransactions($transactions, $address);

        return $result;
    }

    /**
     * @param array $params
     * 
     * @return LengthAwarePaginator
     */
    public function transactions(array $params): LengthAwarePaginator
    {
        // params array to single variables - types already validated in request
        $transactions = $this->transactionRepository->transactionsPaginated(...$params);

        return $transactions;
    }

}
