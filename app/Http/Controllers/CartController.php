<?php

namespace App\Http\Controllers;

use App\Events\NewReservation;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->orderBy('created_at')->get();
        return view('profile.carrito')->with(compact('cart'));
    }

    public function add(Product $product)
    {
        $user = auth()->user();
        $user->cart()->syncWithoutDetaching([$product->id => ['campus_id' => $user->campus_id]]);

        return back();
    }

    public function remove(Product $product)
    {
        $user = auth()->user();
        $user->cart()->detach($product);

        return back();
    }

    public function update(Request $request, CartItem $item)
    {
        $item->update($request->all());

        return back();
    }

    public function submit()
    {
        $items = auth()->user()->cart;

        if ($items->isEmpty()) {
            return back()->with('alert', 'Su canasta está vacía.');
        }

        if (!$items->every(function ($item) {
            return $item->pivot->isAvailable() == CartItem::AVAILABLE;
        })) {
            return back()->with('alert', 'Hay productos en su canasta con fechas faltantes, inválidas o no disponibles.');
        }

        $items->each(function ($item) {
            $item->pivot->submit();
        });

        event(new NewReservation(auth()->user(), $items));
        return back()->with('alert', 'Productos reservados exitosamente.');
    }
}
