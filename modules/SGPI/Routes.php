<?php declare(strict_types=1);

return [


    [['GET', 'POST', 'PUT', 'DELETE'], '/sgpi/master', ['Modules\SGPI\Controllers\Masters', 'SGPIMaster'], ['SGPIMaster', 'sgpi_master']],
    [['GET', 'POST', 'PUT', 'DELETE'], '/sgpi/transactions', ['Modules\SGPI\Controllers\Masters', 'SGPITransactions'], ['SGPITransactions', 'sgpi_transaction']],
    [['GET', 'POST', 'PUT', 'DELETE'], '/sgpi/sgpibalance', ['Modules\SGPI\Controllers\Masters', 'SGPIBalance'], ['SGPIBalance', 'sgpi_balances']],
    [['GET', 'POST', 'PUT', 'DELETE'], '/sgpi/sgpiTransactionView', ['Modules\SGPI\Controllers\Masters', 'sgpiTransactionView'], ['sgpiTransactionView', 'sgpi_transaction']],


    [['GET', 'POST', 'PUT', 'DELETE'], '/api/getSGPIBalance', ['Modules\SGPI\Controllers\API', 'getSGPIBalance'], ['getSGPIBalance', 'loggedin']],
    [['GET', 'POST', 'PUT', 'DELETE'], '/api/getSGPIAccounts', ['Modules\SGPI\Controllers\API', 'getSGPIAccounts'], ['getSGPIAccounts', 'loggedin']],
    [['GET', 'POST', 'PUT', 'DELETE'], '/api/transferSGPI', ['Modules\SGPI\Controllers\API', 'transferSGPI'], ['transferSGPI', 'loggedin']],

    [['GET', 'POST', 'PUT', 'DELETE'], '/api/getSGPIConsitency', ['Modules\SGPI\Controllers\API', 'getSGPIConsitency'], ['getSGPIConsitency', 'loggedin']],
    [['GET', 'POST', 'PUT', 'DELETE'], '/api/getSgpiDistribution', ['Modules\SGPI\Controllers\API', 'getSgpiDistribution'], ['getSgpiDistribution', 'loggedin']],
    [['GET', 'POST', 'PUT', 'DELETE'], '/api/getSgpiType', ['Modules\SGPI\Controllers\API', 'getSgpiType'], ['getSgpiType', 'loggedin']],
    [['GET', 'POST', 'PUT', 'DELETE'], '/api/getSgpiTrend', ['Modules\SGPI\Controllers\API', 'getSgpiTrend'], ['getSgpiTrend', 'loggedin']],


    [['GET', 'POST', 'PUT', 'DELETE'], '/api/getSgpiTransactionView', ['Modules\SGPI\Controllers\API', 'getSgpiTransactionView'], ['getSgpiTransactionView', 'loggedin']],


];