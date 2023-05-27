<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemsController extends Controller
{
    public function index()
    {
        // Mengambil daftar item pesanan
        $orderItems = OrderItem::all();

        // Mengembalikan daftar item pesanan sebagai response JSON
        return response()->json($orderItems);
    }

    public function show($id)
    {
        // Mengambil data item pesanan berdasarkan ID
        $orderItem = OrderItem::findOrFail($id);

        // Mengembalikan data item pesanan sebagai response JSON
        return response()->json($orderItem);
    }
    public function store(Request $request)
    {
        // Validasi inputan form order item
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Simpan order item baru ke database
        $orderItem = new OrderItem;
        $orderItem->order_id = $request->order_id;
        $orderItem->product_id = $request->product_id;
        $orderItem->quantity = $request->quantity;
        $orderItem->price = $request->price;
        // setel nilai atribut lainnya
        $orderItem->save();

        // Redirect atau tampilkan pesan sukses
    }

    public function update(Request $request, $id)
    {
        // Validasi inputan form update order item
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Temukan order item yang akan diupdate
        $orderItem = OrderItem::findOrFail($id);

        // Update atribut order item
        $orderItem->quantity = $request->quantity;
        $orderItem->price = $request->price;
        // setel atribut lainnya yang ingin diupdate

        // Simpan perubahan pada order item
        $orderItem->save();

        // Redirect atau tampilkan pesan sukses
    }

    public function destroy($id)
    {
        // Temukan order item yang akan dihapus
        $orderItem = OrderItem::findOrFail($id);

        // Hapus order item dari database
        $orderItem->delete();

        // Redirect atau tampilkan pesan sukses
    }
}
