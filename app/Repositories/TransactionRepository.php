<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TransactionRepository {

    /**
     * @param array $transactions
     * @param string $address
     * 
     * @return array
     */
    public function saveTransactions(array $transactions, string $address): array
    {
        $response = [
            'created' => 0,
            'errors' => 0
        ];
        
        foreach ($transactions['result'] as $transaction) {
            try {
                $transaction['address'] = $address;
                DB::table('transactions')->insert($transaction);
                $response['created']++;
            } catch (\Throwable $th) {
                Log::error($th->getMessage().' blockNumber: '.json_encode($transaction['blockNumber']));
            
                $response['created']++;
            }
        }
        return $response;
    }


    public function transactionsPaginated(string $address, int $itemsPerPage, int $page, array $sortBy, string $search): LengthAwarePaginator
    {
        // -1 value : return all in one page - count all transactions 
        if ($itemsPerPage == -1) {
            $itemsPerPage = DB::table('transactions')->count();
        } 

        // Resolve $page for laravel paginator
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return Transaction::where('address', $address)->paginate($itemsPerPage);
        // return Transaction::get(10);
    }


}
