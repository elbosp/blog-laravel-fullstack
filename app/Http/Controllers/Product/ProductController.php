<?php

namespace App\Http\Controllers\Product;

use App\Product;

class ProductController extends Controller
{
    public function custom()
    {
        return response()->json(
            Product::all('price')->each(function ($product) { // THE BENEFIT IS YOU ONLY MAKE ONE LINE CODE
                $product->price *= rand(10,100);
                $product->newAttribute = 'some-value';
            })
        );
    }

    public function when()
    {
        return response()->json(
            Product::all()->when(request()->optionIsTrue, function ($products) {
                $products->where('option', request()->option);
            })
        );
    }

    public function tap()
    {
        return response()->json(
            Product::all('price')->tap(function ($products) { // THE BENEFIT IS YOU ONLY MAKE ONE LINE CODE
                Log::debug("collection: {$products}"); // DO SOMETHING THAT WILL NOT AFFECTING THE COLLECTION ITSELF
            })
        );
    }

    public function count()
    {
        return response()->json(
            Product::all()->map(function ($product) {
                return $product->price;
            })->filter(function ($price) {
                return $price > 200;
            })->reduce(function ($total, $price) {
                return $total + 1;
            })
        );

        return response()->json(
            Product::where('price', '>', 200)->count() // WHERE CLAUSE IS ALWAYS BETTER
        );
    }

    public function sum()
    {
        return response()->json(
            Product::all()->map(function ($product) {
                return $product->price;
            })->filter(function ($price) {
                return $price > 200;
            })->reduce(function ($total, $price) {
                return $total + $price;
            })
        );

        return response()->json(
            Product::where('price', '>', 200)->pluck('price')->sum() // WHERE CLAUSE IS ALWAYS BETTER
        );

        // AN AWESOME OPERATIONS
        return response()->json(
            Product::pluck('price')->sum()
        );
        return response()->json(
            Product::pluck('price')->min()
        );
        return response()->json(
            Product::pluck('price')->max()
        );
        return response()->json(
            Product::pluck('price')->avg()
        );
        return response()->json(
            Product::pluck('price')->median()
        );
    }

    public function pluck()
    {
        return response()->json(
            Product::pluck('price')
        );
    }

    public function shuffle()
    {
        return response()->json(
            Product::all()->shuffle()
        );
    }

    public function random()
    {
        return response()->json(
            Product::all()->random()
        );
    }
}