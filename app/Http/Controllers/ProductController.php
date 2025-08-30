<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Maker;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Color;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $makers = Maker::all();
        return view('admin.products.create', compact('categories', 'makers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'maker_id' => 'required|exists:makers,id',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Producto creado exitosamente.');
    }
    public function show(Product $product)
    {
        // Fetch all sizes and colors for the product
        $sizes = Size::all();
        $colors = Color::all();
        // Fetch product variants for the product
        $product_variants = Product::find($product->id)->variants()->get();
        return view('admin.products.show', compact('product', 'product_variants', 'sizes', 'colors'));
    }
    public function edit(Product $product)
    {
        $categories = Category::all();
        $makers = Maker::all();
        return view('admin.products.edit', compact('product', 'categories', 'makers'));
    }
    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'maker_id' => 'exists:makers,id',
            'category_id' => 'exists:categories,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $product->update([
            'name' => $validated['name'] ?? $product->name,
            'description' => $validated['description'] ?? $product->description,
            'maker_id' => $validated['maker_id'] ?? $product->maker_id,
            'category_id' => $validated['category_id'] ?? $product->category_id,
            'is_active' => $validated['is_active'] ?? $product->is_active,
            'is_featured' => $validated['is_featured'] ?? $product->is_featured,
        ]);
        return redirect()->route('admin.products')->with('success', 'Producto actualizado exitosamente.');
    }
}
