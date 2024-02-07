<?php

namespace App\Console\Commands;

use App\Services\HttpServices;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Services\TransactionServices;
use App\Repositories\TransactionRepository;
use App\Http\Controllers\TransactionController;

class EtherscanFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'etherscan:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch transactions using etherscan API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $params = [
            'address' => '0xaa7a9ca87d3694b5755f213b5d04094b8d0f0a6f'
        ];
        $transactionRepository = new TransactionRepository;
        $httpServices = new HttpServices;
        $transactionServices = new TransactionServices($transactionRepository, $httpServices);
        
        try {
            $response = $transactionServices->transactionsFetch($params);
        
            // Provjera odgovora i izvršavanje odgovarajućih radnji
            if ($response) {
                $this->info('Transaction fetch success.');
            } else {
                $this->error('Transaction Error: ' . json_encode($response));
            }
        } catch (\Exception $e) {
            // Uhvati bilo kakve izuzetke koji se mogu dogoditi prilikom slanja zahtjeva
            $this->error('Došlo je do greške prilikom slanja HTTP zahtjeva: ' . $e->getMessage());
        }

    }
}
