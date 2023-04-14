<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $categories = $seller->products()
            ->with('categories')
            ->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values(); // para asegurarnos de que no quedan espacios vacios al eliminar elementos 
        return $this->showAll($categories);
    }
}
