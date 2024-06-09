<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ProductStockController extends Controller
{
    public function addProductAndStock(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'seller_id' => 'required|exists:users,id',
        'price' => 'required|numeric',
        'amount' => 'required|integer',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg',
    ]);

    $product = Product::where('name', $validated['name'])->first();

    if ($product) {
        $imagePath = $product->image_path;  // Use existing image path
    } else {
        if ($request->hasFile('image')) {
            $imageName = $validated['name'] . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;

            $product = Product::create([
                'name' => $validated['name'],
                'image_path' => $imagePath,
            ]);
        } else {
            return response()->json(['message' => 'Image is required for new products'], 422);
        }
    }

    Stock::create([
        'product_id' => $product->id,
        'seller_id' => $validated['seller_id'],
        'price' => $validated['price'],
        'amount' => $validated['amount'],
    ]);

    return response()->json(['message' => 'Product and stock entry created successfully'], 200);
}



    public function getUserStock($userId)
    {
        $stocks = Stock::with('product')->where('seller_id', $userId)->get();
        
        $stocks->each(function($stock) {
            $stock->product->image_url = url('images/' . basename($stock->product->image_path));
        });
    
        return response()->json($stocks, 200);
    }
    

    public function updateStock(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'amount' => 'required|integer',
    ]);

    $stock = Stock::findOrFail($id);
    $stock->update($validated);

    $product = $stock->product;
    if ($product) {
        $product->name = $validated['name'];
        $product->save();
    }

    return response()->json(['message' => 'Stock entry updated successfully'], 200);
}

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product and associated stock entries deleted successfully'], 200);
    }

    public function deleteCart($id)
    {
        $stock = Cart::findOrFail($id);
        $stock->delete();

        return response()->json(['message' => 'Stock entry deleted successfully'], 200);
    }

    public function getAllStockItems()
{
    $items = DB::table('stocks')
        ->join('products', 'stocks.product_id', '=', 'products.id')
        ->join('users', 'stocks.seller_id', '=', 'users.id')
        ->select('stocks.id as stock_id','products.image_path as image_path', 'products.name as product_name', 'users.name as seller_name', 'stocks.price', 'stocks.amount')
        ->get();

        $items->each(function($items) {
            $items->image_url = url('images/' . basename($items->image_path));
        });
        

    return response()->json($items);
}


   
}
