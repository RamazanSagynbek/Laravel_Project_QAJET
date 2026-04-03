<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'listings' => Listing::count(),
            'products' => Product::count(),
            'services' => Service::count(),
            'active_listings' => Listing::where('status', 'active')->count(),
            'active_products' => Product::where('status', 'active')->count(),
            'active_services' => Service::where('status', 'active')->count(),
        ];

        $latestUsers = User::latest()->take(10)->get();
        $latestListings = Listing::with('user')->latest()->take(10)->get();
        $latestProducts = Product::with('user')->latest()->take(10)->get();
        $latestServices = Service::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'latestUsers', 'latestListings', 'latestProducts', 'latestServices'));
    }

    public function deleteListing(Listing $listing)
    {
        $listing->delete();
        return back()->with('success', 'Listing deleted by admin.');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted by admin.');
    }

    public function deleteService(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Service deleted by admin.');
    }
}
