<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(auth()->user()->products()->get());
    }

    public function show($id)
    {
        return response()->json(auth()->user()->products()->find($id));
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'price' => 'required|integer',
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        return response()->json(auth()->user()->products()->save(new Product(request()->all())));
    }

    public function update($id)
    {
        $validator = Validator::make(request()->all(), [
            'price' => 'integer',
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $product = auth()->user()->products()->find($id);

        if (empty($product))
        {
            return response()->json([
                'message' => "Product not found"
            ], 404);
        }

        if ($product->fill(request()->all())->save())
        {
            return response()->json([
                'message' => "Product updated"
            ]);
        }
    }

    public function destroy($id)
    {
        $product = auth()->user()->products()->find($id);

        if (empty($product))
        {
            return response()->json([
                'message' => "Product not found"
            ], 404);
        }

        if ($product->delete())
        {
            return response()->json([
                'message' => "Product deleted"
            ]);
        }
    }
}
