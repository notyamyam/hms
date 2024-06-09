<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $product = Product::find($id);
    
            if ($product) {
                $product->image_url = url('images/' . basename($product->image_path));
                return response()->json($product);
            } else {
                return response()->json(['error' => 'Product not found'], 404);
            }
        } else {
            $products = Product::all();
            $products->each(function($product) {
                $product->image_url = url('images/' . basename($product->image_path));
            });
    
            return response()->json($products);
        }
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $product = Product::findOrFail($id);
    
        // Update name if it's different from the original name
        if ($request->filled('name') && $validated['name'] !== $product->name) {
            $product->name = $validated['name'];
        }
    
        // Handle image update
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $validated['name'] . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image_path = 'images/' . $imageName;
        }
    
        $product->save();
    
        return response()->json(['message' => 'Product updated successfully'], 200);
    }
    
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
