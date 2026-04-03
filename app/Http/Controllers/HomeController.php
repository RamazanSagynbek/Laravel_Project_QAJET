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

        return view('home', compact('listings', 'products', 'services'));
    }
}
