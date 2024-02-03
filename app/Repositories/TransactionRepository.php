<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionRepository {

    /**
     * @param array $transactions
     * @param string $address
     * 
     * @return \stdClass
     */
    public function saveTransactions(array $transactions, string $address): \stdClass
    {
        $count = new \stdClass;
        $count->created = 0;
        $count->errors = 0;
        foreach ($transactions['result'] as $transaction) {
            try {
                $transaction['address'] = $address;
                DB::table('transactions')->insert($transaction);
                $count->created++;
            } catch (\Throwable $th) {
                Log::error($th->getMessage().' blockNumber: '.json_encode($transaction['blockNumber']));
                $count->errors++;
            }
        }
        return $count;
    }

}
