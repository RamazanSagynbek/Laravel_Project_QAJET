<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 'active')->with('user', 'category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::where('type', 'product')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'product')->get();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $request->user()->products()->create($validated);

        return redirect()->route('products.index')->with('success', 'Product listed successfully!');
    }

    public function show(Product $product)
    {
        $product->load('user', 'category', 'reviews.user');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::where('type', 'product')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.show', $product)->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}
