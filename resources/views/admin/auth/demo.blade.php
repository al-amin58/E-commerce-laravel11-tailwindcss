<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validate the request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'thumbnail_image' => 'required|string',
            'product_title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'size' => 'nullable|exists:sizes,id',
            'colors' => 'array',
            'colors.*' => 'exists:colors,id',
            'attribute' => 'nullable|exists:attributes,id',
        ]);

        // Logic to add the product to the cart
        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity; // Update quantity if already in cart
        } else {
            $cart[$productId] = [
                "name" => $request->product_title,
                "thumbnail_image" => $request->thumbnail_image,
                "price" => $request->price,
                "quantity" => $request->quantity,
                "size" => $request->size,
                "colors" => $request->colors,
                "attribute" => $request->attribute,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => 'Product added to cart']);
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart')); // Assuming you have a cart view in cart/index.blade.php
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return response()->json(['success' => 'Product removed from cart']);
        }

        return response()->json(['error' => 'Product not found in cart'], 404);
    }

    public function clearCart()
    {
        session()->forget('cart');
        return response()->json(['success' => 'Cart cleared']);
    }
}
