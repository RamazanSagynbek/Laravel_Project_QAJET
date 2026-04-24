<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ManagesResource;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    use ManagesResource;

    protected function getStoragePath(): string
    {
        return 'listings';
    }

    protected function getIndexRoute(): string
    {
        return 'listings.index';
    }

    protected function getShowRoute(): string
    {
        return 'listings.show';
    }

    protected function getResourceName(): string
    {
        return 'Listing';
    }

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
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                  ->orWhere('description', 'like', $search);
            });
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
        return $this->storeResource($request, $request->validated(), 'listings');
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
        return $this->updateResource($request, $listing, $request->validated());
    }

    public function destroy(Listing $listing)
    {
        return $this->destroyResource($listing);
    }
}
