<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(25);
        return view('order/admin/orders', ['orders' => $orders]);
    }

    public function list()
    {
        $user = auth()->user();

        $orders = Order::where('user_id', $user->id)->get();

        return view('order/customer/orders', ['orders' => $orders]);
    }

    public function detail(Order $order)
    {
        return view('order/customer/order_show', ['order' => $order]);
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();
        $cart = $user->cart();
        $cartProducts = $cart->cartProducts;

        if ($cartProducts->isEmpty()) {
            return redirect()->back()->with(['error' => 'Your cart is empty!']);
        }

        // Validar o address_id vindo do formulário
        $validator = Validator::make($request->all(), [
            'address_id' => ['required', 'exists:addresses,id'],
        ], [
            'address_id.required' => "You need to select a shipping address!",
            'address_id.exists' => "The given shipping address is invalid!",
        ]);

        if ($validator->fails()) {
            // Pega o primeiro erro
            $firstError = $validator->errors()->first();

            // Redireciona com o primeiro erro
            return redirect()->back()->with('error', $firstError);
        }

        // Criar a ordem
        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $request->address_id, // Associa o endereço
            'total' => $cart->cartTotal(),
        ]);

        foreach ($cartProducts as $cartProduct) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cartProduct->product->id,
                'quantity' => $cartProduct->quantity,
                'price' => $cartProduct->price,
            ]);
        }

        // Limpar o carrinho
        $cart->delete();

        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
