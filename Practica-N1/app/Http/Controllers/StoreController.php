<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\products;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    //Muestra la vista de la tabla de productos en la vista dashboard
    public function products_table()
    {
        $products = products::all();
        return view('store.products', compact('products'));
    }

    // //Muestra la vista de la tabla de productos para eliminarlos
    // public function delete_product_table()
    // {
    //     $products = products::all();
    //     return view('store.delete_product', compact('products'));
    // }

    //Manda a la vista de la tabla usuarios
    public function users_table()
    {
        $users = User::all();
        return view('store.users', compact('users'));
    }
}
