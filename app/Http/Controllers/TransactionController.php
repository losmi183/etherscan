<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\TransactionServices;
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

        return response()->json([
            'message' => 'Fetsh transaction from external API and insert into database finished.',
            'data' => $result
        ]); 
    }


}
