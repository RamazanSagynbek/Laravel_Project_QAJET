<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:listing,product,service',
            'id' => 'required|integer',
        ]);

        $modelClass = match ($validated['type']) {
            'listing' => \App\Models\Listing::class,
            'product' => \App\Models\Product::class,
            'service' => \App\Models\Service::class,
        };

        $model = $modelClass::findOrFail($validated['id']);

        $request->user()->favorites()->firstOrCreate([
            'favoritable_type' => $modelClass,
            'favoritable_id' => $model->id,
        ]);

        return back()->with('success', 'Added to favorites!');
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:listing,product,service',
            'id' => 'required|integer',
        ]);

        $modelClass = match ($validated['type']) {
            'listing' => \App\Models\Listing::class,
            'product' => \App\Models\Product::class,
            'service' => \App\Models\Service::class,
        };

        Favorite::where('user_id', $request->user()->id)
            ->where('favoritable_type', $modelClass)
            ->where('favoritable_id', $validated['id'])
            ->delete();

        return back()->with('success', 'Removed from favorites.');
    }
}
