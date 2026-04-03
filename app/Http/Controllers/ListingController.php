<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::where('status', 'active')->with('user');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('rooms')) {
            $query->where('rooms', $request->rooms);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $listings = $query->latest()->paginate(12);

        return view('listings.index', compact('listings'));
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(StoreListingRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('listings', 'public');
        }

        $request->user()->listings()->create($validated);

        return redirect()->route('listings.index')->with('success', 'Listing created successfully!');
    }

    public function show(Listing $listing)
    {
        $listing->load('user', 'reviews.user');
        return view('listings.show', compact('listing'));
    }

    public function edit(Listing $listing)
    {
        $this->authorize('update', $listing);
        return view('listings.edit', compact('listing'));
    }

    public function update(UpdateListingRequest $request, Listing $listing)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($listing->image) {
                Storage::disk('public')->delete($listing->image);
            }
            $validated['image'] = $request->file('image')->store('listings', 'public');
        }

        $listing->update($validated);

        return redirect()->route('listings.show', $listing)->with('success', 'Listing updated!');
    }

    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);

        if ($listing->image) {
            Storage::disk('public')->delete($listing->image);
        }

        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Listing deleted!');
    }
}
