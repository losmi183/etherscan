<?php

return [

    'apiUrl' => env('APIURL', 'https://api.etherscan.io/api'),
    'apiKey' => env('APIKEY', 'TNUVKECD24EGY85MU2GBMFHKY5P7MVZ29R'),
    'module' => env('MODULE', 'account'),
    'action' => env('ACTION', 'txlist'),
    'startblock' => env('STARTBLOCK', '9000000'),
    'endblock' => env('ENDBLOCK', 'latest'),

];
