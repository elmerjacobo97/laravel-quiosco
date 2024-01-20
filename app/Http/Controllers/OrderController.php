<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los pedidos con status = 0 y con el usuario quién lo creó esa orden.
        return new OrderCollection(Order::with('user')->with('products')->where('status', 0)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Almacenar la orden
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total = $request->total; // Total: columna de BD total y lo que mando desde el frontend (total)
        $order->save();

        // Almacenar los productos
        // 1. Obtener el ID de la orden
        // 2. Obtener los productos
        // 3. Formatear un arreglo
        // 4. Almacenar en la BD

        $id = $order->id;
        $products = $request->products; // Estos products se mandan desde el frontend
        $order_producto = [];

        foreach ($products as $product) {
            $order_producto[] = [
                'order_id' => $id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        OrderProduct::insert($order_producto);

        return [
            'message' => 'Order realizado correctamente, estará listo en unos minutos.',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->status = 1;
        $order->save();

        return [
            'message' => 'Order updated successfully',
            'order' => $order
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
