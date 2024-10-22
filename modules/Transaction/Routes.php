<?php declare(strict_types = 1);

return [
    /*
     * Transaction Web routes
     */
    [['GET','POST','PUT','DELETE'], '/transaction/voucher', ['Modules\Transaction\Controllers\Transaction', 'transactionVoucher'],['transaction_voucher','voucher']],
    [['GET','POST','PUT','DELETE'], '/transaction/{id}', ['Modules\Transaction\Controllers\Transaction', 'transaction'],['transaction','loggedin']],
    [['GET','POST','PUT','DELETE'], '/addtransaction/{id}', ['Modules\Transaction\Controllers\Transaction', 'addtransaction'],['add_transaction','loggedin']],
    [['GET','POST','PUT','DELETE'], '/getTransactionProducts', ['Modules\Transaction\Controllers\Transaction', 'getTransactionProducts'],['transaction_getProducts','loggedin']],
    [['GET','POST'], '/deleteTransaction', ['Modules\Transaction\Controllers\Transaction', 'deleteTransaction'],['transaction_deleteTransaction','ess']],
    [['GET','POST'], '/changeTranStatus/{svid}', ['Modules\Transaction\Controllers\Transaction', 'changeTranStatus'],['transaction_changeTranStatus','ess']],

    [['GET'], '/transactions/reco/{svid}', ['Modules\Transaction\Controllers\Transaction', 'transactionReco'],['transactionReco','loggedin']],
    
    /*
     * Transaction API's routes
     */
    [['GET','POST','PUT','DELETE'], '/api/getTransactionTypes', ['Modules\Transaction\Controllers\API', 'getTransactionTypes'],['transaction_vouchers','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/createStockVoucher', ['Modules\Transaction\Controllers\API', 'createStockVoucher'],['transaction_vouchers','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/inventoryView', ['Modules\Transaction\Controllers\API', 'inventoryView'],['transaction_inventoryView','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/StockView', ['Modules\Transaction\Controllers\API', 'StockView'],['transaction_StockView','loggedin']],
    
];