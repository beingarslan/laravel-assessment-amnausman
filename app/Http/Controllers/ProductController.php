<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client_id)
    {
        $user = User::isClient()->where('id', $client_id)->with('products', 'productPrices')->first();

        if (!$user) {
            abort(404);
        }

        return view('admin.products.index', compact('user', 'client_id'));
    }

    public function ajax(Request $request)
    {
        $q = $request->get('q');

        if ($q) {
            $products = Product::select('id', 'title as name')
                ->search($q)
                ->get();
        } else {
            $products = Product::select('id', 'title as name')->take(150)->get();
        }

        return response()->json($products);
    }

    public function list(Request $request)
    {
        $products = Product::with('productPrices', 'productPrices.user')->paginate(12);

        return view('admin.products.list', compact('products'));
    }
}
