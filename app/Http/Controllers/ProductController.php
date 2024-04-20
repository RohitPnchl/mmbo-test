<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->latest()->get();

        return view('users.products.index', compact('products'));
    }

    public function create()
    {
        return view('users.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $imageName = $this->imageUplaod($request->file('image'));

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('users.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = $this->imageUplaod($request->file('image'));
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => isset($imageName) ? $imageName : $product->image
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();

        return back()->with('success', 'Product deleted successfully.');
    }

    public function imageUplaod($image)
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = storage_path('app/public') . "/products/";
        $image->move($imagePath, $imageName);

        return "/products/".$imageName;
    }
}
