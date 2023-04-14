<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoryTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $transactions = $category->products()
            ->whereHas('transactions') // pregunta que a al menos tenga una transaccción
            ->with('transactions') // le dice que añada las transacciones, el cual sera una lista
            ->get() // le dice que traiga los datos
            ->pluck('transactions') // le dice que solo necesita las transacciones, retornando una lista de listas de tr
            ->collapse(); // le dice que vuelva todo una sola lista


        return $this->showAll($transactions);
    }
}
