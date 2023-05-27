<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   // ...

   public function create()
    {
        // Menampilkan form untuk membuat produk baru
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form produk
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Mengunggah file gambar
        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = asset('storage/' . $imagePath);

        // Membuat produk baru dan menyimpannya ke database
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->image = $imageUrl;
        $product->save();

        // Redirect atau tampilkan pesan sukses
    }

    public function edit($id)
    {
        // Menampilkan form untuk mengedit produk
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validasi inputan form produk
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Mengunggah file gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = asset('storage/' . $imagePath);
        }

        // Mengupdate data produk
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category = $request->category;
        if ($request->hasFile('image')) {
            $product->image = $imageUrl;
        }
        $product->save();

        // Redirect atau tampilkan pesan sukses
    }

    public function destroy($id)
    {
        // Menghapus produk
        $product = Product::findOrFail($id);
        $product->delete();

        // Redirect atau tampilkan pesan sukses
    }

}