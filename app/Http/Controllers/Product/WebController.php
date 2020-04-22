<?php

namespace App\Http\Controllers\Product;

use App\Product;

class WebController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin())
        {
            return view('some_view', [
                'products' => Product::all()
            ]);
        }
        else
        {
            return view('some_view', [
                'products' => auth()->user()->products
            ]);
        }
    }

    public function show($id)
    {
        if (auth()->user()->isAdmin())
        {
            return view('some_view', [
                'products' => Product::find($id)
            ]);
        }
        else
        {
            return view('some_view', [
                'products' => auth()->user()->products()->find($id)
            ]);
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
            abort(400);
        }

        if (auth()->user()->isAdmin())
        {
            return view('some_view', [
                'product' => Product::create(request()->all())
            ]);
        }
        else
        {
            return view('some_view', [
                'product' => auth()->user()->products()->save(new Product(request()->all()))
            ]);
        }
    }

    public function update($id)
    {
        $validator = Validator::make(request()->all(), [
            'price' => 'integer',
        ]);

        if ($validator->fails())
        {
            abort(400);
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
            abort(404);
        }

        return view('some_view', [
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
            abort(404);
        }

        return view('some_view', [
            'deleted' => $product->delete(),
            'message' => "Product deleted"
        ]);
    }
}