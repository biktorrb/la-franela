<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends Controller
{
    public function index() {
        $product_variants = ProductVariant::all();
        return view('admin.product_variants.index', compact('product_variants'));
    }
    public function create()
    {
        $sizes = Size::all();
        $colors = Color::all();
        $products = Product::all();
        return view('admin.product_variants.create', compact('products', 'sizes', 'colors'));
    }
    public function store(Request $request, Product $product)
    {   
    
        $validated = $request->validate([
            'size_id' => 'required',
            'color_id' => 'required',
            'stock' => 'required| numeric',
            'price' => 'required| numeric',
            'discount' => 'nullable|numeric',
        ]);        
        DB::beginTransaction();
        try {
            if ($validated['size_id'] === 'other') {
                $size = Size::create([
                    'name' => $request->input('size_name'),
                    'type' => $request->input('size_type')
                ]);
                $validated['size_id'] = $size->id;
            }
            if ($validated['color_id'] === 'other') {
                $color = Color::create([
                    'name' => $request->input('color_name'),
                    'hex_code' => $request->input('color_hex'),
                ]);
                $validated['color_id'] = $color->id;
            }
            $sku = str_replace(' ', '', $product->name).$validated['size_id'].$validated['color_id'];
            $validated['sku'] = $sku;
            $validated['product_id'] = $product->id;
            print_r ($validated);
            ProductVariant::create($validated);
            DB::commit();
            return redirect()->route('admin.products.show', $product->id)
                ->with('success', 'La variante fue agregada satisfactoriamente.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Error al agregar la variante: ' . $e->getMessage()])
                ->withInput();
        }
        
    }

    public function show($id)
    {
        // Logic to show a specific product variant
    }


    public function update(Request $request, $id)
    {
        // Logic to update a specific product variant
    }

    public function destroy($id)
    {
        // Logic to delete a specific product variant
    }
}
