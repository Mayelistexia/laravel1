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

   
public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'products' => 'required|array',
    ]);

    DB::beginTransaction();

    try {
        $total = 0;
        $items = [];

        foreach ($request->products as $productId => $data) {
            if (isset($data['selected'])) {
                $product = Product::findOrFail($productId);
                $qty = intval($data['quantity'] ?? 1);
                $price = $product->price;

                $total += ($price * $qty);

                $items[] = [
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'price' => $price,
                ];
            }
        }

        // Simpan order
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'total_price' => $total,
            'user_id' => Auth::id(),
        ]);

        // Simpan order items
        foreach ($items as $item) {
            $item['order_id'] = $order->id;
            OrderItem::create($item);
        }

        DB::commit();
        return redirect()->route('orders.index')->with('success', 'Transaksi berhasil disimpan!');

    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors('Gagal menyimpan transaksi: ' . $e->getMessage());
    }
}


    // Tampilkan detail pesanan
    public function show(Order $order)
    {
        $this->authorize('view', $order); // pastikan user hanya bisa lihat pesanan miliknya
        $order->load('items.product');
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
{
    $this->authorize('delete', $order); // Kalau pakai policy. Bisa dihapus kalau tidak perlu

    // Hapus semua item terkait
    $order->items()->delete();

    // Hapus order
    $order->delete();

    return redirect()->route('orders.index')->with('success', 'Transaksi berhasil dihapus!');
}

}
