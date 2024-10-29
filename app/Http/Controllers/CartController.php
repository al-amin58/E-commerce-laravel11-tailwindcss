<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use session;
class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            // Validate incoming request data
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'nullable|integer|min:1',
                'total_price' => 'required',
                'thumbnail_image' => 'required|string',
                'product_title' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'size' => 'nullable|string',
                'colors' => 'array',
                'colors.*' => 'exists:colors,id',
                'attribute' => 'nullable|string',
            ]);

            // Create or retrieve the user's cart
            $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

            // Check if the item already exists in the cart
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                // Update the quantity if it already exists
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                // Create a new cart item
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'total_price'=> $request->total_price,
                    'size' =>  $request->size,
                    'colors' => json_encode($request->colors), // Store colors as JSON
                    'attribute' => $request->attribute,
                    'thumbnail_image' => $request->thumbnail_image,
                    'product_title' => $request->product_title,
                    'price' => $request->price,
                ]);
            }

            return redirect()->back()->with('success', 'Product added to cart');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // General error handling for other unexpected issues
            return response()->json(['error' => 'An error occurred while adding the product to the cart.'], 500);
        }
    }



    public function showCart()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $mainCategories = $this->getMainCategories();

        $cart = Cart::where('user_id', auth()->id())->with('items.product')->first();

        $items = $cart ? $cart->items : collect();

        $totalPrice = CartItem::where('cart_id', $cart->id)->sum('total_price');

        $totalItems = CartItem::where('cart_id', $cart->id)->count();

        return view('website.cart', compact('items', 'mainCategories', 'totalItems', 'totalPrice'));
    }

    public function updateQuantity(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::find($cartItemId);
        if ($cartItem) {
            $cartItem->quantity = $request->input('quantity');
            $cartItem->total_price = $cartItem->quantity * ($cartItem->product->discount_price ?? $cartItem->product->price);
            $cartItem->save();

            return response()->json(['success' => true, 'total_price' => $cartItem->total_price]);
        }

        return response()->json(['success' => false], 404);
    }

    private function getMainCategories()
    {
        return MainCategory::with(['subCategories' => function ($query) {
            $query->where('status', 'active');
        }])->where('status', 'active')->get();
    }

    public function removeFromCart($productId)
    {
        $cartItem = CartItem::findOrFail($productId);
        $cartItem->delete();
        return redirect()->back()->with('success', 'Item deleted successfully!');
    }


}
