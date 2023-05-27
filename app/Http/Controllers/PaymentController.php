<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function index()
    {
        // Mengambil daftar pembayaran
        $payments = Payment::all();

        // Mengembalikan daftar pembayaran sebagai response JSON
        return response()->json($payments);
    }

    public function show($id)
    {
        // Mengambil data pembayaran berdasarkan ID
        $payment = Payment::findOrFail($id);

        // Mengembalikan data pembayaran sebagai response JSON
        return response()->json($payment);
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_amount' => 'required|numeric',
            'payment_method' => 'required',
            'payment_date' => 'required|date',
        ]);

        // Membuat pembayaran baru
        $payment = Payment::create([
            'order_id' => $request->input('order_id'),
            'payment_amount' => $request->input('payment_amount'),
            'payment_method' => $request->input('payment_method'),
            'payment_date' => $request->input('payment_date'),
        ]);

        // Mengembalikan data pembayaran yang baru dibuat sebagai response JSON
        return response()->json($payment, 201);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'order_id' => 'exists:orders,id',
            'payment_amount' => 'numeric',
            'payment_method' => 'string',
            'payment_date' => 'date',
        ]);

        // Mengambil data pembayaran berdasarkan ID
        $payment = Payment::findOrFail($id);

        // Memperbarui data pembayaran
        $payment->update($request->only([
            'order_id',
            'payment_amount',
            'payment_method',
            'payment_date',
        ]));

        // Mengembalikan data pembayaran yang diperbarui sebagai response JSON
        return response()->json($payment);
    }

    public function destroy($id)
    {
        // Mengambil data pembayaran berdasarkan ID
        $payment = Payment::findOrFail($id);

        // Menghapus pembayaran
        $payment->delete();

        // Mengembalikan response JSON sukses
        return response()->json(['message' => 'Payment deleted']);
    }
}

