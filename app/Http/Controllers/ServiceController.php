<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::where('status', 'active')->with('user', 'category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->filled('price_type')) {
            $query->where('price_type', $request->price_type);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $services = $query->latest()->paginate(12);
        $categories = Category::where('type', 'service')->get();

        return view('services.index', compact('services', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'service')->get();
        return view('services.create', compact('categories'));
    }

    public function store(StoreServiceRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $request->user()->services()->create($validated);

        return redirect()->route('services.index')->with('success', 'Service listed successfully!');
    }

    public function show(Service $service)
    {
        $service->load('user', 'category', 'reviews.user');
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $this->authorize('update', $service);
        $categories = Category::where('type', 'service')->get();
        return view('services.edit', compact('service', 'categories'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('services.show', $service)->with('success', 'Service updated!');
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted!');
    }
}
