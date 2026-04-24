<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user->loadCount(['listings', 'products', 'services']);

        $listings = $user->listings()->where('status', 'active')->latest()->take(6)->get();
        $products = $user->products()->where('status', 'active')->latest()->take(6)->get();
        $services = $user->services()->where('status', 'active')->latest()->take(6)->get();

        return view('users.show', compact('user', 'listings', 'products', 'services'));
    }
}
