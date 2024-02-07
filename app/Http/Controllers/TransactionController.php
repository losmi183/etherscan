<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\TransactionServices;
use App\Http\Requests\TransactionsRequest;
use App\Http\Requests\TransactionsFetchRequest;

class TransactionController extends Controller
{
    
    /**
     * transactionsFetch - params validation and run transactionsFetch Service
     * return respons - count created transactions
     * 
     * @param TransactionsFetchRequest $request
     * @param TransactionServices $transactionServices
     * 
     * @return JsonResponse
     */
    public function transactionsFetch(TransactionsFetchRequest $request, TransactionServices $transactionServices): JsonResponse
    {
        $params = $request->validated();

        $result = $transactionServices->transactionsFetch($params);

        return response()->json($result); 
    }


    /**
     * @param TransactionsRequest $request
     * @param TransactionServices $transactionServices
     * 
     * @return JsonResponse
     */
    public function transactions(TransactionsRequest $request, TransactionServices $transactionServices): JsonResponse
    {
        $params = $request->validated();

        $result = $transactionServices->transactions($params);

        return response()->json($result); 
    }

    /**
     * Return first walet with address
     * 
     * @return [type]
     */
    public function wallet()
    {
        $wallet = Wallet::first();
        return response()->json([
            'data' => $wallet
        ]); 
    }


}
