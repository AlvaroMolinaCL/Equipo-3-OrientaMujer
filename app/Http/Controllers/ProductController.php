<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $categorias = [
        'Ayuda legal de familia',
        'Asesoría civil',
        'Defensa penal',
        'Trámites notariales',
        'Mediación',
    ];

    public function create()
    {
        return view('tenants.default.products.create', [
            'categorias' => $this->categorias,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Producto creado con éxito');
    }

    public function index()
    {
        $products = Product::all(); // Podís usar paginate si querís

        return view('tenants.default.products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        return view('tenants.default.products.edit', [
            'product' => $product,
            'categorias' => $this->categorias,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Elimina la imagen anterior si existe
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Producto actualizado');
    }

    public function destroy(Product $product)
    {
        // Borra la imagen si existe
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado');
    }
        public function planes()
    {
        $products = Product::all(); // o los productos filtrados por tipo = "plan"
        return view('tenants.default.planes.index', compact('products'));
    }

}
