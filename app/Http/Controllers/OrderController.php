<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Menampilkan semua pesanan user saat ini
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    // Form buat pesanan baru (sementara satu produk saja)
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    // Simpan pesanan
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($request->product_id);
            $total = $product->price * $request->quantity;

            // Simpan order
            $order = Order::create([
                'user_id'     => Auth::id(),
                'status'      => 'pending',
                'total_price' => $total,
            ]);

            // Simpan item
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
                'price'      => $product->price,
            ]);

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    // Tampilkan detail pesanan
    public function show(Order $order)
    {
        $this->authorize('view', $order); // pastikan user hanya bisa lihat pesanan miliknya
        $order->load('items.product');
        return view('orders.show', compact('order'));
    }
}
