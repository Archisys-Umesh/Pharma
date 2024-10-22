<?php declare(strict_types = 1);

return [
    
    [['GET','POST'], '/orders', ['Modules\Orders\Controllers\Orders', 'primaryOrders'],['orders_primary','order']],
    
    [['GET','POST'], '/order/{id}', ['Modules\Orders\Controllers\Orders', 'order'],['order','loggedin']],
    [['GET','POST'], '/printorder/{order_id}', ['Modules\Orders\Controllers\Orders', 'printorder'],['printorder','loggedin']],
    [['GET','POST'], '/deleteOrder/{order_id}', ['Modules\Orders\Controllers\Orders', 'deleteOrder'],['deleteOrder','loggedin']],
    [['GET','POST'], '/addOli/{id}', ['Modules\Orders\Controllers\Orders', 'addOli'],['order_addOli','loggedin']],
    [['GET','POST'], '/getProducts/{pricebook_id}', ['Modules\Orders\Controllers\Orders', 'getProducts'],['order_getProducts','loggedin']],
        
    [['GET','POST'], '/order/status/{order_id}', ['Modules\Orders\Controllers\Orders', 'changeOrderStatus'],['order_changeStatus','loggedin']],
    
    [['GET','POST'], '/orders/createShipping/{order_id}', ['Modules\Orders\Controllers\Orders', 'createShippingOrder'],['createShippingOrder','loggedin']],
    [['GET','POST'], '/shippingorder/{id}', ['Modules\Orders\Controllers\Orders', 'shippingView'],['shippingView','loggedin']],
    [['GET','POST'], '/changeShippingStatus/{soid}', ['Modules\Orders\Controllers\Orders', 'changeShippingStatus'],['changeShippingStatus','loggedin']],
    
    [['GET','POST'], '/allocateview/{soid}', ['Modules\Orders\Controllers\Orders', 'AllocateView'],['AllocateView','loggedin']],
    
    [['GET','POST'], '/ShippingList', ['Modules\Orders\Controllers\Orders', 'ShippingList'],['ShippingList','loggedin']],
    
    
    [['GET','POST'], '/api/addOrder', ['Modules\Orders\Controllers\API', 'addOrder'],['orders_secondary','loggedin']],
    [['GET','POST'], '/api/getFrequentlyOrder', ['Modules\Orders\Controllers\API', 'getFrequentlyOrder'],['orders_secondary','loggedin']],
    [['GET','POST'], '/api/getSuggestiveOrder', ['Modules\Orders\Controllers\API', 'getSuggestiveOrder'],['orders_secondary','loggedin']],
    [['GET','POST'], '/api/getFilterSuggestiveOrder', ['Modules\Orders\Controllers\API', 'getFilterSuggestiveOrder'],['orders_secondary','loggedin']],
    
    [['GET','POST'], '/api/getOrderForGRN', ['Modules\Orders\Controllers\API', 'getOrderForGRN'],['orders_getOrderForGRN','loggedin']],
    [['GET','POST'], '/api/getShippingOrderDetails', ['Modules\Orders\Controllers\API', 'getShippingOrderDetails'],['orders_getShippingOrderDetails','loggedin']],
    [['GET','POST'], '/api/ProcessShippingOrder', ['Modules\Orders\Controllers\API', 'ProcessShippingOrder'],['orders_ProcessShippingOrder','loggedin']],

    [['GET','POST'], '/api/BookRetailSale', ['Modules\Orders\Controllers\API', 'BookRetailSale'],['orders_BookRetailSale','loggedin']],
    [['GET','POST'], '/api/orderDelete', ['Modules\Orders\Controllers\API', 'orderDelete'],['orders_delete','loggedin']],
    
    
    [['GET','POST'], '/api/getPrimaryOrder', ['Modules\Orders\Controllers\API', 'getPrimaryOrder'],['order','any']],
    [['GET','POST'], '/api/changeOrderStatus', ['Modules\Orders\Controllers\API', 'changeOrderStatus'],['order','any']],
    [['GET','POST'], '/api/orderMarkDelivered', ['Modules\Orders\Controllers\API', 'orderMarkDelivered'],['order','any']],
    [['GET','POST'], '/api/orderLogs', ['Modules\Orders\Controllers\API', 'orderLogs'],['order','any']],
        
    
];