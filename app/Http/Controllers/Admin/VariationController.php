<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Variation;
use App\Models\Product;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    // Show all variations
    public function index()
    {
        $variations = Variation::with('product')->latest()->paginate(10);
        return view('admin.variations.index', compact('variations'));
    }

    // Show create form
    public function create()
    {
        $products = Product::all();
        return view('admin.variations.create', compact('products'));
    }

    // Store new variation
    public function store(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|unique:variations,serial_number',
            'product_id' => 'required|exists:products,id',
        ]);

          Variation::create($request->only(['serial_number', 'product_id']));


        return redirect()->route('admin.variations.index')->with('success', 'Variation created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $variation = Variation::findOrFail($id);
        $products = Product::all();
        return view('admin.variations.edit', compact('variation', 'products'));
    }

    // Update variation
    public function update(Request $request, $id)
    {
        $variation = Variation::findOrFail($id);

        $request->validate([
            'serial_number' => 'required|unique:variations,serial_number,' . $variation->id,
            'product_id' => 'required|exists:products,id',
        ]);

        $variation->update($request->all());

        return redirect()->route('admin.variations.index')->with('success', 'Variation updated successfully.');
    }

    // Delete variation
    public function destroy($id)
    {
        Variation::destroy($id);
        return redirect()->route('admin.variations.index')->with('success', 'Variation deleted successfully.');
    }
    
    public function getByProduct($productId)
{
    $variations = Variation::where('product_id', $productId)->get(['serial_number']);
    return response()->json($variations);
}
    
    
}
