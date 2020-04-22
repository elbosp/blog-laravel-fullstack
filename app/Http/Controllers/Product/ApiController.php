<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin())
        {
            return response()->json(Product::all());
        }
        else
        {
            return response()->json(auth()->user()->products);
        }
    }

    public function show($id)
    {
        if (auth()->user()->isAdmin())
        {
            return response()->json(Product::find($id));
        }
        else
        {
            return response()->json(auth()->user()->products()->find($id));
        }
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'price' => 'required|integer',
            'user_id' => auth()->user()->isAdmin() ? 'required|integer' : 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        if (auth()->user()->isAdmin())
        {
            return response()->json(Product::create(request()->all()));
        }
        else
        {
            return response()->json(auth()->user()->products()->save(new Product(request()->all())));
        }
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

        if (auth()->user()->isAdmin())
        {
            $product = Product::find($id);
        }
        else
        {
            $product = auth()->user()->products()->find($id);
        }

        if (empty($product))
        {
            return response()->json([
                'message' => "Product not found"
            ], 404);
        }

        return response()->json([
            'updated' => $product->fill(request()->all())->save(),
            'message' => "Product updated"
        ]);
    }

    public function destroy($id)
    {
        if (auth()->user()->isAdmin())
        {
            $product = Product::find($id);
        }
        else
        {
            $product = auth()->user()->products()->find($id);
        }

        if (empty($product))
        {
            return response()->json([
                'message' => "Product not found"
            ], 404);
        }

        return response()->json([
            'deleted' => $product->delete(),
            'message' => "Product deleted"
        ]);
    }
}