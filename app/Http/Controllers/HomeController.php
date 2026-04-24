<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Product;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $listings = Listing::where('status', 'active')->latest()->take(6)->get();
        $products = Product::where('status', 'active')->latest()->take(6)->get();
        $services = Service::where('status', 'active')->latest()->take(6)->get();

        $stats = $this->cacheRemember('home.stats', 300, fn () => [
            'listings_count' => Listing::where('status', 'active')->count(),
            'products_count' => Product::where('status', 'active')->count(),
            'services_count' => Service::where('status', 'active')->count(),
            'users_count' => \App\Models\User::count(),
        ]);

        return view('home', compact('listings', 'products', 'services', 'stats'));
    }
}
