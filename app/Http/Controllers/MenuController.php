<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $tableNumber = $request->query('meja'); 
        if ($tableNumber) {
            Session::put('table_number', $tableNumber);
        }

        $items = Item::with('category')
            ->where('is_available', true)
            ->orderBy('item_name', 'asc')
            ->get();

        return view('customer.menu', compact('items', 'tableNumber'));
    }

    public function cart(Request $request)
    {
        $cart = Session::get('cart', []);
        return view('customer.cart', compact('cart'));
    }

    public function AddToCart(Request $request)
    {
        $menuId = $request->input('id');
        $menu = Item::find($menuId);

        if (!$menu) {
            return response()->json(['status' => 'error', 'message' => 'Menu item not found.'], 404);
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] += 1;
        } else {
            $cart[$menuId] = [
                'id' => $menu->id,
                'item_name' => $menu->item_name,
                'price' => $menu->price,
                'image' => $menu->image,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'status' => 'success', 
            'message' => 'Item added to cart!', 
            'cart' => $cart,
            'cart_count' => count($cart)
        ]);
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang.');
    }
}