<?php declare(strict_types = 1);

return [
    
    [['GET','POST','PUT','DELETE'], '/offer/offers', ['Modules\Offers\Controllers\Masters', 'offers'],['offer_offers','loggedin']],
    
    /*API Document Keys*/
    [['GET','POST','PUT','DELETE'], '/api/getOffers', ['Modules\Offers\Controllers\API', 'getOffers'],['offers','loggedin']],
];