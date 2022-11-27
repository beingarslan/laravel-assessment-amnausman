<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPriceRequest;
use App\Http\Requests\UpdateProductPriceRequest;
use App\Models\ProductPrice;

class ProductPriceController extends Controller
{
    public function storeProductPrice(StoreProductPriceRequest $request)
    {
        $productPrices = [];
        foreach ($request->product_id as $productId) {
            ProductPrice::UpdateOrCreate(
                [
                    'user_id' => $request->client_id,
                    'product_id' => $productId,
                ],
                [
                    'price' => $request->price,
                    'user_id' => $request->client_id,
                    'product_id' => $productId,
                ]
            );
        }

        return redirect()->back()->with('success', 'Product price added successfully');
    }
}
