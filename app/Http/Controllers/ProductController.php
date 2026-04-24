<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ManagesResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ManagesResource;

    protected function getStoragePath(): string
    {
        return 'products';
    }

    protected function getIndexRoute(): string
    {
        return 'products.index';
    }

    protected function getShowRoute(): string
    {
        return 'products.show';
    }

    protected function getResourceName(): string
    {
        return 'Product';
    }

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
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                  ->orWhere('description', 'like', $search);
            });
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
        return $this->storeResource($request, $request->validated(), 'products');
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
        return $this->updateResource($request, $product, $request->validated());
    }

    public function destroy(Product $product)
    {
        return $this->destroyResource($product);
    }
}
