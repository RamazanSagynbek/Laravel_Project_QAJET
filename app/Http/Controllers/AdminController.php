<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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

        $latestUsers = User::latest()->paginate(10, ['*'], 'users_page');
        $latestListings = Listing::with('user')->latest()->paginate(10, ['*'], 'listings_page');
        $latestProducts = Product::with('user')->latest()->paginate(10, ['*'], 'products_page');
        $latestServices = Service::with('user')->latest()->paginate(10, ['*'], 'services_page');

        return view('admin.dashboard', compact('stats', 'latestUsers', 'latestListings', 'latestProducts', 'latestServices'));
    }

    public function deleteListing(Listing $listing)
    {
        if ($listing->image) {
            Storage::disk(config('filesystems.default', 'public'))->delete($listing->image);
        }
        $listing->delete();
        return back()->with('success', 'Listing deleted by admin.');
    }

    public function deleteProduct(Product $product)
    {
        if ($product->image) {
            Storage::disk(config('filesystems.default', 'public'))->delete($product->image);
        }
        $product->delete();
        return back()->with('success', 'Product deleted by admin.');
    }

    public function deleteService(Service $service)
    {
        if ($service->image) {
            Storage::disk(config('filesystems.default', 'public'))->delete($service->image);
        }
        $service->delete();
        return back()->with('success', 'Service deleted by admin.');
    }
}
