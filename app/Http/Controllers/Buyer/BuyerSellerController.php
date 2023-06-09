<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()->with('product.seller')
        ->get()
        ->pluck('product.seller')
        ->unique('id')
        ->values(); // elimina los elementos vacios de la collection
        
        return $this->showAll($sellers);
    }
}
